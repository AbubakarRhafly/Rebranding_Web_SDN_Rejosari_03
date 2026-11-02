<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Guru;
use App\Models\Pengumuman;
use App\Models\User;
use App\Support\StorageFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorageFileFallbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_storage_file_helper_returns_url_only_when_file_exists(): void
    {
        Storage::fake('public');

        // File does not exist
        $this->assertNull(StorageFile::url('berita/nonexistent.jpg'));
        $this->assertFalse(StorageFile::exists('berita/nonexistent.jpg'));

        // Put a fake file
        Storage::disk('public')->put('berita/test.jpg', 'fake-content');

        $this->assertNotNull(StorageFile::url('berita/test.jpg'));
        $this->assertTrue(StorageFile::exists('berita/test.jpg'));
        $this->assertStringContainsString('storage/berita/test.jpg', StorageFile::url('berita/test.jpg'));
    }

    public function test_guru_displays_placeholder_when_photo_file_is_missing(): void
    {
        Storage::fake('public');

        // Create guru with path to nonexistent file
        $guru = Guru::create([
            'nama' => 'Guru Uji Coba',
            'jabatan' => 'Guru Kelas 1',
            'foto' => 'guru/crop/nonexistent.jpg',
            'foto_awal' => 'guru/asli/nonexistent.jpg',
            'status' => 'aktif',
            'urutan' => 1,
        ]);

        $this->assertNull($guru->foto_url);
        $this->assertNull($guru->foto_awal_url);

        // Authenticate admin
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.guru.index'));
        $response->assertStatus(200);
        $response->assertSee('Tanpa Foto');
        $response->assertDontSee('guru/crop/nonexistent.jpg');

        // Client directory page
        $clientResponse = $this->get(route('guru.index'));
        $clientResponse->assertStatus(200);
        $clientResponse->assertSee('Foto belum tersedia');
        $clientResponse->assertDontSee('guru/crop/nonexistent.jpg');
    }

    public function test_berita_displays_placeholder_when_thumbnail_file_is_missing(): void
    {
        Storage::fake('public');

        $berita = Berita::create([
            'judul' => 'Berita Gambar Hilang',
            'slug' => 'berita-gambar-hilang',
            'isi' => 'Konten berita.',
            'thumbnail' => 'berita/nonexistent.jpg',
            'status' => 'published',
            'tanggal_publish' => now(),
        ]);

        $this->assertNull($berita->thumbnail_url);

        // Client berita list
        $response = $this->get(route('berita.index'));
        $response->assertStatus(200);
        $response->assertSee('SDN Rejosari 03');
        $response->assertDontSee('storage/berita/nonexistent.jpg');

        // Admin berita list
        $admin = User::factory()->create();
        $adminResponse = $this->actingAs($admin)->get(route('admin.berita.index'));
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Tidak ada thumbnail');
        $adminResponse->assertDontSee('storage/berita/nonexistent.jpg');
    }

    public function test_admin_can_remove_thumbnail_from_berita(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('thumb.jpg', 100, 'image/jpeg');
        $path = $file->store('berita', 'public');

        $berita = Berita::create([
            'judul' => 'Berita Dengan Thumbnail',
            'slug' => 'berita-dengan-thumbnail',
            'isi' => 'Konten berita.',
            'thumbnail' => $path,
            'status' => 'published',
            'tanggal_publish' => now(),
        ]);

        $this->assertTrue(Storage::disk('public')->exists($path));

        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.berita.update', $berita->id), [
            'judul' => 'Berita Dengan Thumbnail',
            'slug' => 'berita-dengan-thumbnail',
            'isi' => 'Konten berita.',
            'status' => 'published',
            'hapus_thumbnail' => '1',
        ]);

        $response->assertRedirect(route('admin.berita.index'));
        $berita->refresh();
        $this->assertNull($berita->thumbnail);
        $this->assertFalse(Storage::disk('public')->exists($path));
    }

    public function test_admin_can_remove_photo_from_pengumuman(): void
    {
        Storage::fake('public');
        $foto = UploadedFile::fake()->create('pengumuman.jpg', 100, 'image/jpeg');
        $fotoPath = $foto->store('pengumuman/foto', 'public');

        $pengumuman = Pengumuman::create([
            'judul' => 'Pengumuman Penting',
            'isi' => 'Isi pengumuman.',
            'foto' => $fotoPath,
            'tanggal_mulai' => now(),
            'status' => 'published',
        ]);

        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.pengumuman.update', $pengumuman->id), [
            'judul' => 'Pengumuman Penting',
            'isi' => 'Isi pengumuman.',
            'tanggal_mulai' => now()->format('Y-m-d'),
            'status' => 'published',
            'hapus_foto' => '1',
        ]);

        $response->assertRedirect(route('admin.pengumuman.index'));
        $pengumuman->refresh();
        $this->assertNull($pengumuman->foto);
        $this->assertFalse(Storage::disk('public')->exists($fotoPath));
    }
}
