<?php

namespace App\Console\Commands;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\GalleryFoto;
use App\Models\Guru;
use App\Models\KegiatanLomba;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Support\StorageFile;
use Illuminate\Console\Command;

class SyncMissingStorageFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:sync-missing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up database file references whose physical files do not exist on disk';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking and syncing missing files in database...');

        $guruCount = 0;
        foreach (Guru::all() as $guru) {
            $changed = false;
            if ($guru->foto !== null && ! StorageFile::exists($guru->foto)) {
                $guru->foto = null;
                $changed = true;
            }
            if ($guru->foto_awal !== null && ! StorageFile::exists($guru->foto_awal)) {
                $guru->foto_awal = null;
                $changed = true;
            }
            if ($changed) {
                $guru->save();
                $guruCount++;
            }
        }
        $this->line("Guru synced: {$guruCount}");

        $beritaCount = 0;
        foreach (Berita::all() as $berita) {
            if ($berita->thumbnail !== null && ! StorageFile::exists($berita->thumbnail)) {
                $berita->thumbnail = null;
                $berita->save();
                $beritaCount++;
            }
        }
        $this->line("Berita synced: {$beritaCount}");

        $pengumumanCount = 0;
        foreach (Pengumuman::all() as $pengumuman) {
            $changed = false;
            if ($pengumuman->foto !== null && ! StorageFile::exists($pengumuman->foto)) {
                $pengumuman->foto = null;
                $changed = true;
            }
            if ($pengumuman->lampiran !== null && ! StorageFile::exists($pengumuman->lampiran)) {
                $pengumuman->lampiran = null;
                $changed = true;
            }
            if ($changed) {
                $pengumuman->save();
                $pengumumanCount++;
            }
        }
        $this->line("Pengumuman synced: {$pengumumanCount}");

        $galleryCount = 0;
        foreach (Gallery::all() as $gallery) {
            if ($gallery->thumbnail !== null && ! StorageFile::exists($gallery->thumbnail)) {
                $gallery->thumbnail = null;
                $gallery->save();
                $galleryCount++;
            }
        }
        $this->line("Gallery synced: {$galleryCount}");

        $galleryFotoCount = 0;
        foreach (GalleryFoto::all() as $foto) {
            if ($foto->foto !== null && ! StorageFile::exists($foto->foto)) {
                $foto->foto = null;
                $foto->save();
                $galleryFotoCount++;
            }
        }
        $this->line("GalleryFoto synced: {$galleryFotoCount}");

        $siswaCount = 0;
        foreach (Siswa::all() as $siswa) {
            if ($siswa->foto !== null && ! StorageFile::exists($siswa->foto)) {
                $siswa->foto = null;
                $siswa->save();
                $siswaCount++;
            }
        }
        $this->line("Siswa synced: {$siswaCount}");

        $kegiatanCount = 0;
        foreach (KegiatanLomba::all() as $kegiatan) {
            $changed = false;
            if ($kegiatan->dokumentasi !== null && ! StorageFile::exists($kegiatan->dokumentasi)) {
                $kegiatan->dokumentasi = null;
                $changed = true;
            }
            if ($kegiatan->foto !== null && ! StorageFile::exists($kegiatan->foto)) {
                $kegiatan->foto = null;
                $changed = true;
            }
            if ($changed) {
                $kegiatan->save();
                $kegiatanCount++;
            }
        }
        $this->line("KegiatanLomba synced: {$kegiatanCount}");

        $this->info('Storage and database sync completed successfully.');

        return Command::SUCCESS;
    }
}
