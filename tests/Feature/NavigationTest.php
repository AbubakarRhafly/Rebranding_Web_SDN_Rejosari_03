<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\Pengumuman;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_navigation_routes_are_accessible(): void
    {
        $routes = [
            '/' => 200,
            '/profil' => 200,
            '/visi-misi' => 200,
            '/kontak' => 200,
            '/guru' => 200,
            '/siswa' => 200,
            '/gallery' => 200,
            '/beritadanpengumuman' => 200,
            '/berita' => 301,
            '/pengumuman' => 302, // sengaja dialihkan ke halaman berita#pengumuman
            '/kegiatan-lomba' => 200,
            '/pengaduan' => 200,
        ];

        foreach ($routes as $route => $expectedStatus) {
            $response = $this->get($route);
            $this->assertEquals($expectedStatus, $response->status(), "Route {$route} returned {$response->status()} instead of {$expectedStatus}");
        }
    }

    public function test_navbar_renders_compact_menu_and_drawer(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Check desktop navigation items
        $response->assertSee('Beranda');
        $response->assertSee('Tentang');
        $response->assertSee('Informasi');
        $response->assertSee('Galeri');
        $response->assertSee('Pengaduan');

        // Check mobile drawer markup and aligned menus
        $response->assertSee('mobile-nav-drawer');
        $response->assertSee('drawer-toggle');
        $response->assertSee('drawer-close');
        $response->assertSee('Profil Sekolah');
        $response->assertSee('Visi &amp; Misi', false);
        $response->assertSee('Kontak');
        $response->assertSee('Guru &amp; Tenaga Kependidikan', false);
        $response->assertSee('Data Siswa');
        $response->assertSee('Berita &amp; Pengumuman', false);
        $response->assertSee('Kegiatan &amp; Lomba', false);
    }

    public function test_kontak_page_contains_required_information_and_faq(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);

        $response->assertSee('024 - 340710');
        $response->assertSee('sdnegerirejosari03@gmail.com');
        $response->assertSee('07.00 – 14.00 WIB');
        $response->assertSee('Frequently Asked Questions (FAQ)');
        $response->assertSee('maps.google.com');
    }

    public function test_breadcrumb_renders_on_desktop_pages(): void
    {
        $response = $this->get('/beritadanpengumuman');
        $response->assertStatus(200);

        $response->assertSee('site-breadcrumb');
        $response->assertSee('Beranda');
        $response->assertSee('Berita &amp; Pengumuman', false);
    }

    public function test_pengaduan_form_stores_kategori_keperluan(): void
    {
        $response = $this->post(route('pengaduan.store'), [
            'nama' => 'Orang Tua Murid',
            'email' => 'wali@example.com',
            'no_hp' => '081234567890',
            'kategori_keperluan' => 'Sarana & Prasarana Sekolah',
            'judul' => 'Perbaikan Lampu Kelas 3',
            'isi' => 'Mohon bantuan untuk memeriksa lampu penerangan di kelas 3 yang mulai redup.',
        ]);

        $response->assertRedirect(route('pengaduan.create'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pengaduan', [
            'nama' => 'Orang Tua Murid',
            'email' => 'wali@example.com',
            'kategori_keperluan' => 'Sarana & Prasarana Sekolah',
            'judul' => 'Perbaikan Lampu Kelas 3',
        ]);
    }

    public function test_visi_misi_page_displays_umbi_and_nine_missions(): void
    {
        $response = $this->get('/visi-misi');
        $response->assertStatus(200);

        // Assert Visi UMBI
        $response->assertSee('SD Negeri Rejosari 03 UMBI');
        $response->assertSee('Unggul Budi Pekerti, Maju dalam Bidang IPTEK, Berkarakter, dan Inovatif');

        // Assert Misi points
        $response->assertSee('Taqwa Terhadap Tuhan Yang Maha Esa');
        $response->assertSee('Melayani dengan penuh tanggung jawab');
        $response->assertSee('berbasis IT yang terintegrasi dengan Literasi dan Numerasi');
        $response->assertSee('secara kontinu melalui kelas digital');
        $response->assertSee('lingkungan hidup di sekolah dengan kegiatan pembiasaan');
        $response->assertSee('kebhinekaan global, mencintai budaya lokal dan menjunjung nilai gotong royong');
        $response->assertSee('kemandirian, nalar kritis dan kreativitas');
        $response->assertSee('cepat tanggap terhadap perubahan yang terjadi untuk merancang inovasi');
        $response->assertSee('proses pendampingan dan kerja sama dengan orang tua');

        // Assert 4 pillars
        $response->assertSee('Nilai Utama UMBI');
    }

    public function test_profil_sekolah_displays_updated_information(): void
    {
        $response = $this->get('/profil');
        $response->assertStatus(200);

        $response->assertSee('UMBI (Unggul, Maju IPTEK, Berkarakter, Inovatif)');
        $response->assertSee('024 - 340710');
        $response->assertSee('sdnegerirejosari03@gmail.com');
        $response->assertSee('Kurikulum Merdeka');
    }

    public function test_pengaduan_page_does_not_contain_alur_penanganan(): void
    {
        $response = $this->get('/pengaduan');
        $response->assertStatus(200);

        $response->assertDontSee('Alur Penanganan');
        $response->assertSee('Jaminan Kerahasiaan');
        $response->assertSee('Saluran Alternatif');
    }

    public function test_page_breadcrumbs_are_not_duplicated(): void
    {
        $response = $this->get('/beritadanpengumuman');
        $response->assertStatus(200);
        $response->assertDontSee('info-breadcrumb');

        $responseSiswa = $this->get('/siswa');
        $responseSiswa->assertStatus(200);
        $responseSiswa->assertDontSee('siswa-breadcrumb');
    }

    public function test_berita_detail_page_is_accessible(): void
    {
        $berita = Berita::create([
            'judul' => 'Uji Coba Berita Baru',
            'slug' => 'uji-coba-berita-baru',
            'isi' => 'Ini adalah konten lengkap dari berita uji coba.',
            'kategori' => 'Pendidikan',
            'penulis' => 'Humas Sekolah',
            'status' => 'published',
            'tanggal_publish' => now(),
        ]);

        $response = $this->get(route('berita.show', $berita->slug));
        $response->assertStatus(200);
        $response->assertSee('Uji Coba Berita Baru');
        $response->assertSee('Ini adalah konten lengkap dari berita uji coba.');
        $response->assertSee('Humas Sekolah');
        $response->assertSee('Pendidikan');
    }

    public function test_pengumuman_detail_page_is_accessible(): void
    {
        $pengumuman = Pengumuman::create([
            'judul' => 'Pengumuman Libur Sekolah',
            'isi' => 'Diberitahukan kepada seluruh siswa bahwa kegiatan KBM diliburkan.',
            'tanggal_mulai' => now(),
            'status' => 'published',
        ]);

        $response = $this->get(route('pengumuman.show', $pengumuman->id));
        $response->assertStatus(200);
        $response->assertSee('Pengumuman Libur Sekolah');
        $response->assertSee('Diberitahukan kepada seluruh siswa');
    }

    public function test_berita_cards_contain_links_to_detail_pages(): void
    {
        $berita = Berita::create([
            'judul' => 'Prestasi Juara Lomba Matematika',
            'slug' => 'prestasi-juara-lomba-matematika',
            'isi' => 'Siswa kami berhasil meraih medali emas.',
            'status' => 'published',
            'tanggal_publish' => now(),
        ]);

        $response = $this->get('/beritadanpengumuman');
        $response->assertStatus(200);
        $response->assertSee(route('berita.show', $berita->slug));
        $response->assertDontSee('<details class="info-detail"', false);
    }
}
