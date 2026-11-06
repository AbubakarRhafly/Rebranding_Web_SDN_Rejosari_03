<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AuthSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_portal_masuk_admin_page_is_accessible_and_renders_captcha(): void
    {
        $response = $this->get('/portalmasukadmin');

        $response->assertStatus(200);
        $response->assertSee('Portal Admin');
        $response->assertSee('Verifikasi Keamanan (CAPTCHA)');
        $response->assertSee('<svg', false);
        $this->assertNotEmpty(session('admin_login_captcha'));
    }

    public function test_login_route_returns_404_not_found_without_redirect(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(404);
    }

    public function test_admin_route_returns_404_not_found_without_redirect_for_guests(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(404);

        $responseSub = $this->get('/admin/guru');
        $responseSub->assertStatus(404);
    }

    public function test_captcha_refresh_endpoint_returns_json_with_new_svg(): void
    {
        // First visit to initialize session
        $this->get('/portalmasukadmin');
        $initialCaptcha = session('admin_login_captcha');

        $response = $this->getJson('/portalmasukadmin/captcha-refresh');

        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'svg']);
        $this->assertEquals('success', $response->json('status'));
        $this->assertStringContainsString('<svg', $response->json('svg'));
    }

    public function test_login_fails_if_captcha_is_missing(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@sdnrejosari03.sch.id',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post('/portalmasukadmin', [
            'email' => $user->email,
            'password' => 'secret123',
            'captcha' => '',
        ]);

        $response->assertSessionHasErrors('captcha');
        $this->assertGuest();
    }

    public function test_login_fails_if_captcha_is_incorrect(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@sdnrejosari03.sch.id',
            'password' => Hash::make('secret123'),
        ]);

        $this->get('/portalmasukadmin');

        $response = $this->post('/portalmasukadmin', [
            'email' => $user->email,
            'password' => 'secret123',
            'captcha' => 'WRONGCODE',
        ]);

        $response->assertSessionHasErrors('captcha');
        $this->assertGuest();
    }

    public function test_login_succeeds_with_valid_credentials_and_matching_captcha(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@sdnrejosari03.sch.id',
            'password' => Hash::make('secret123'),
        ]);

        $this->get('/portalmasukadmin');
        $validCaptcha = session('admin_login_captcha');

        $response = $this->post('/portalmasukadmin', [
            'email' => $user->email,
            'password' => 'secret123',
            'captcha' => strtolower($validCaptcha), // Case-insensitive test
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    public function test_pengumuman_foto_rejects_dangerous_file_extensions(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/pengumuman', [
            'judul' => 'Uji Coba Keamanan Foto',
            'isi' => 'Konten pengumuman pengujian berkas berbahaya.',
            'status' => 'published',
            'foto' => UploadedFile::fake()->create('malicious_script.php', 100, 'application/x-php'),
        ]);

        $response->assertSessionHasErrors('foto');
    }

    public function test_pengumuman_can_be_created_without_lampiran(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/pengumuman', [
            'judul' => 'Pengumuman Resmi',
            'isi' => 'Konten pengumuman resmi tanpa berkas lampiran.',
            'status' => 'published',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.pengumuman.index'));
        $this->assertDatabaseHas('pengumuman', [
            'judul' => 'Pengumuman Resmi',
        ]);
    }
}
