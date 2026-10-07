<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilGuruSeeder extends Seeder
{
    public function run(): void
    {
        // Data awal untuk pengembangan lokal.
        // Cocokkan kembali nama dan jabatan dengan bahan yang dikumpulkan.
        $daftarGuru = [
            ['Suparno', 'Kepala Sekolah', 'suparno.jpg'],
            ['Dining Nastiti', 'Guru Kelas 1A', 'dining-nastiti.jpeg'],
            ['Kiky Dialisa', 'Guru Kelas 1B', 'kiky-dialisa.jpg'],
            ['Didik Sutardi', 'Guru Kelas 2A', 'didik-sutardi.jpeg'],
            ['Redy Nofianto', 'Guru Kelas 2B', 'redy-nofianto.png'],
            ['Muryidah Qonitat', 'Guru Kelas 3A', 'muryidah-qonitat.jpg'],
            ['Aknis Etikayani', 'Guru Kelas 3B', 'aknis-etikayani.jpg'],
            ['Eka Novita Retlasari', 'Guru Kelas 4A', 'eka-novita-retlasari.png'],
            ['Rohman', 'Guru Kelas 4B', 'rohman.jpeg'],
            ['Odditya Setiawan', 'Guru Kelas 5A', 'odditya-setiawan.png'],
            ['Petrus Karjana', 'Guru Kelas 5B', 'petrus-karjana.png'],
            ['Riadlul Badiah', 'Guru Kelas 6A', 'riadlul-badiah.jpg'],
            ['Doddy Kholistian Arsyadani', 'Guru Kelas 6B', 'doddy-kholistian-arsyadani.jpeg'],
            ['Arum Wahyuningsih', 'Guru', 'arum-wahyuningsih.jpeg'],
            ['Kusnul Khotimah', 'Guru Pendidikan Agama Islam', 'kusnul-khotimah.jpg'],
            ['Septi Pratiwi', 'Guru Pendidikan Agama Islam', 'septi-pratiwi.png'],
            ['Janti Eko Wulandari', 'Guru Pendidikan Agama Kristen', 'janti-eko-wulandari.jpg'],
            ['Rizal Yulianiman Fauzi', 'Guru PJOK', 'rizal-yulianiman-fauzi.jpeg'],
            ['Rizki Adi Ridfandani', 'Guru PJOK', 'rizki-adi-ridfandani.jpeg'],
            ['Peni Widiastu', 'Tenaga Administrasi', 'peni-widiastu.jpg'],
            ['Agus Juwanto', 'Petugas Keamanan', 'agus-juwanto.png'],
        ];

        DB::transaction(function () use ($daftarGuru) {
            foreach ($daftarGuru as $index => [$nama, $jabatan, $foto]) {
                Guru::firstOrCreate(
                    ['nama' => $nama],
                    [
                        'jabatan' => $jabatan,
                        'foto' => 'images/guru/' . $foto,
                        'kata_kata' => null,
                        'urutan' => $index + 1,
                        'status' => 'aktif',
                    ]
                );
            }
        });
    }
}