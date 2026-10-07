<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@sdnrejosari03.sch.id',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Editor Website',
                'email' => 'editor@sdnrejosari03.sch.id',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | GURU
        |--------------------------------------------------------------------------
        */

        DB::table('guru')->insert([

            [
                'nama' => 'SUPARNO, S.Pd.M.Pd',
                'jabatan' => 'Kepala Sekolah',
                'foto' => null,
                'kata_kata' => 'Jalani hidup dengan ikhlas',
                'urutan' => 1,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'DINING NASTITI, S.Pd.',
                'jabatan' => 'Pengajar Kelas 1A',
                'foto' => null,
                'kata_kata' => 'Semua impian kita bisa terwujud jika kita memiliki keberanian untuk mengejarnya',
                'urutan' => 2,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'KIKY DIALISA, S.Pd.',
                'jabatan' => 'Pengajar Kelas 1B',
                'foto' => null,
                'kata_kata' => 'Perjalanan ribuan mil dimulai dari satu langkah',
                'urutan' => 3,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'DIDIK SUTARDI, S.Pd.',
                'jabatan' => 'Pengajar Kelas 2A',
                'foto' => null,
                'kata_kata' => 'Jika ingin sukses jadilah manut dan patuh',
                'urutan' => 4,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'REDY NOFIYANTO, S.Pd.',
                'jabatan' => 'Pengajar Kelas 2B',
                'foto' => null,
                'kata_kata' => 'Jika ingin sukses jadilah manut dan patuh',
                'urutan' => 5,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'MURSYIDAH QONITAT, S.Pd.',
                'jabatan' => 'Pengajar Kelas 3A',
                'foto' => null,
                'kata_kata' => 'Man Jadda Wa Jadda',
                'urutan' => 6,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'AKNIS ETIKAYANI, S.Pd.',
                'jabatan' => 'Pengajar Kelas 3B',
                'foto' => null,
                'kata_kata' => 'Selalu Mencintai Semua Makhluk Allah SWT',
                'urutan' => 7,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'EKA NOVITA RETLASARI, S.Pd.',
                'jabatan' => 'Pengajar Kelas 4A',
                'foto' => null,
                'kata_kata' => 'Hidup adalah sebuah pilihan, jika kamu tidak memilih apapun berarti itu pilihanmu',
                'urutan' => 8,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'ROHMAN, S.Pd.',
                'jabatan' => 'Pengajar Kelas 4B',
                'foto' => null,
                'kata_kata' => 'Man Jadda Wa Jadda',
                'urutan' => 9,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'ODDITYA SETIAWAN, S.Pd.',
                'jabatan' => 'Pengajar Kelas 5A',
                'foto' => null,
                'kata_kata' => 'Hidup untuk dinikmati dan disyukuri',
                'urutan' => 10,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'PETRUS KARJANA, A.Ma.',
                'jabatan' => 'Pengajar Kelas 5B',
                'foto' => null,
                'kata_kata' => 'Keep calm and drive on',
                'urutan' => 11,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'RIADLUL BADI\'AH, S.Pd.',
                'jabatan' => 'Pengajar Kelas 6A',
                'foto' => null,
                'kata_kata' => 'Setiap orang adalah guru, setiap tempat adalah sekolah, dan setiap saat adalah belajar.',
                'urutan' => 12,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'DODDY KHOLISTIAN ARSYADANI, S.Pd.',
                'jabatan' => 'Pengajar Kelas 6B',
                'foto' => null,
                'kata_kata' => 'Learning By Doing',
                'urutan' => 13,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'KUSNUL KHOTIMAH, S.Pd.I',
                'jabatan' => 'Pengajar Pendidikan Agama Islam',
                'foto' => null,
                'kata_kata' => 'Maka sesungguhnya bersama kesulitan itu ada kemudahan. (QS Al Insyirah 5)',
                'urutan' => 14,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'JANTI EKO WULANDARI, S.Pd.',
                'jabatan' => 'Pengajar Pendidikan Agama Kristen',
                'foto' => null,
                'kata_kata' => 'Bekerja dan berdoa',
                'urutan' => 15,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'RIZKI ADI RIDFANDANI, S.Pd.',
                'jabatan' => 'Pengajar PJOK',
                'foto' => null,
                'kata_kata' => 'Khoirunnas anfauhum linnas',
                'urutan' => 16,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'ARUM WAHYUNINGSIH',
                'jabatan' => 'Penjaga Sekolah',
                'foto' => null,
                'kata_kata' => 'Wong nandur bakale ngunduh, Jer basuki mawa bea',
                'urutan' => 17,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'RIZAL YULIAN IMAN FAUZI, S.Pd.',
                'jabatan' => 'Pengajar PJOK',
                'foto' => null,
                'kata_kata' => 'Cita-citamu kelak akan kamu raih di saat dirimu selalu menghormati kedua orang tuamu',
                'urutan' => 18,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama' => 'PENI WIDIASTU, S.E.',
                'jabatan' => 'Staff Administrasi',
                'foto' => null,
                'kata_kata' => 'Semangat meraih mimpi',
                'urutan' => 19,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SISWA
        |--------------------------------------------------------------------------
        */

        DB::table('siswa')->insert([
            [
                'nama' => 'Ahmad Fajar',
                'kelas' => '6A',
                'foto' => null,
                'deskripsi' => 'Siswa kelas 6A SDN Rejosari 03 Semarang.',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Salsabila',
                'kelas' => '5A',
                'foto' => null,
                'deskripsi' => 'Siswa kelas 5A SDN Rejosari 03 Semarang.',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bagas Pratama',
                'kelas' => '6B',
                'foto' => null,
                'deskripsi' => 'Siswa kelas 6B SDN Rejosari 03 Semarang.',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Nabila Putri',
                'kelas' => '6A',
                'foto' => null,
                'deskripsi' => 'Siswa kelas 6A SDN Rejosari 03 Semarang.',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | GALLERY
        |--------------------------------------------------------------------------
        */

        DB::table('gallery')->insert([
            [
                'judul' => 'Upacara Bendera',
                'deskripsi' => 'Kegiatan upacara bendera SDN Rejosari 03 Semarang.',
                'tanggal' => '2026-01-12',
                'thumbnail' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kegiatan Pembelajaran',
                'deskripsi' => 'Dokumentasi kegiatan pembelajaran siswa.',
                'tanggal' => '2026-02-10',
                'thumbnail' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kegiatan Olahraga',
                'deskripsi' => 'Kegiatan olahraga dan PJOK siswa.',
                'tanggal' => '2026-03-05',
                'thumbnail' => null,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | GALLERY FOTO
        |--------------------------------------------------------------------------
        */

        DB::table('gallery_foto')->insert([
            [
                'gallery_id' => 1,
                'foto' => null,
                'keterangan' => 'Upacara bendera siswa',
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gallery_id' => 1,
                'foto' => null,
                'keterangan' => 'Peserta upacara',
                'urutan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gallery_id' => 2,
                'foto' => null,
                'keterangan' => 'Kegiatan pembelajaran di kelas',
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gallery_id' => 3,
                'foto' => null,
                'keterangan' => 'Kegiatan olahraga siswa',
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | BERITA
        |--------------------------------------------------------------------------
        */

        DB::table('berita')->insert([
            [
                'judul' => 'Kegiatan Pembelajaran SDN Rejosari 03',
                'slug' => 'kegiatan-pembelajaran-sdn-rejosari-03',
                'thumbnail' => null,
                'isi' => 'Kegiatan pembelajaran di SDN Rejosari 03 Semarang dilaksanakan dengan berbagai aktivitas yang mendukung proses belajar siswa.',
                'kategori' => 'Pendidikan',
                'penulis' => 'Administrator',
                'tanggal_publish' => '2026-01-15 08:00:00',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kegiatan Siswa SDN Rejosari 03',
                'slug' => 'kegiatan-siswa-sdn-rejosari-03',
                'thumbnail' => null,
                'isi' => 'Berbagai kegiatan siswa dilaksanakan sebagai bagian dari pengembangan kemampuan akademik maupun nonakademik.',
                'kategori' => 'Kegiatan',
                'penulis' => 'Administrator',
                'tanggal_publish' => '2026-02-20 09:00:00',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | PENGUMUMAN
        |--------------------------------------------------------------------------
        */

        DB::table('pengumuman')->insert([
            [
                'judul' => 'Pemberitahuan Kegiatan Sekolah',
                'isi' => 'Diberitahukan kepada seluruh siswa dan orang tua/wali mengenai pelaksanaan kegiatan sekolah.',
                'tanggal_mulai' => '2026-01-10',
                'tanggal_selesai' => '2026-01-20',
                'lampiran' => null,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Jadwal Kegiatan Siswa',
                'isi' => 'Siswa diharapkan mengikuti kegiatan sekolah sesuai dengan jadwal yang telah ditentukan.',
                'tanggal_mulai' => '2026-02-01',
                'tanggal_selesai' => '2026-02-15',
                'lampiran' => null,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | PENGADUAN
        |--------------------------------------------------------------------------
        */

        DB::table('pengaduan')->insert([
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'no_hp' => '081234567890',
                'judul' => 'Saran Fasilitas Sekolah',
                'isi' => 'Saya ingin memberikan saran mengenai peningkatan fasilitas sekolah.',
                'status' => 'selesai',
                'tanggapan' => 'Terima kasih atas saran yang diberikan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Rahma',
                'email' => 'siti@example.com',
                'no_hp' => '081298765432',
                'judul' => 'Saran Kegiatan Siswa',
                'isi' => 'Mohon dapat ditambahkan kegiatan yang mendukung kreativitas siswa.',
                'status' => 'diproses',
                'tanggapan' => 'Saran sedang dipertimbangkan oleh pihak sekolah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | KEGIATAN LOMBA
        |--------------------------------------------------------------------------
        */

        DB::table('kegiatan_lomba')->insert([
            [
                'kategori' => 'MAPSI',
                'judul' => 'Lomba MAPSI Cabang Tilawah',
                'nama_peserta' => 'Ahmad Fajar',
                'kelas' => '6A',
                'jenis_kegiatan' => 'Tilawah',
                'tingkat' => 'Kecamatan',
                'hasil' => 'Juara 1',
                'tanggal' => '2026-02-10',
                'foto' => null,
                'deskripsi' => 'Mengikuti perlombaan MAPSI cabang Tilawah tingkat kecamatan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'MAPSI',
                'judul' => 'Lomba MAPSI Cabang Kaligrafi',
                'nama_peserta' => 'Salsabila',
                'kelas' => '5A',
                'jenis_kegiatan' => 'Kaligrafi',
                'tingkat' => 'Kecamatan',
                'hasil' => 'Juara 2',
                'tanggal' => '2026-02-10',
                'foto' => null,
                'deskripsi' => 'Mengikuti perlombaan MAPSI cabang Kaligrafi tingkat kecamatan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'Literasi',
                'judul' => 'Lomba Membaca Puisi',
                'nama_peserta' => 'Bagas Pratama',
                'kelas' => '6B',
                'jenis_kegiatan' => 'Puisi',
                'tingkat' => 'Kota',
                'hasil' => 'Juara 1',
                'tanggal' => '2026-03-15',
                'foto' => null,
                'deskripsi' => 'Mengikuti lomba membaca puisi tingkat kota.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'Bahasa Jawa',
                'judul' => 'Lomba Pidato Bahasa Jawa',
                'nama_peserta' => 'Nabila Putri',
                'kelas' => '6A',
                'jenis_kegiatan' => 'Pidato',
                'tingkat' => 'Kecamatan',
                'hasil' => 'Juara 2',
                'tanggal' => '2026-04-05',
                'foto' => null,
                'deskripsi' => 'Mengikuti lomba pidato Bahasa Jawa tingkat kecamatan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'Siswa Berprestasi',
                'judul' => 'Siswa Berprestasi Tahun 2026',
                'nama_peserta' => 'Rizky Maulana',
                'kelas' => '6A',
                'jenis_kegiatan' => 'Akademik',
                'tingkat' => 'Sekolah',
                'hasil' => 'Terpilih',
                'tanggal' => '2026-05-10',
                'foto' => null,
                'deskripsi' => 'Siswa terpilih sebagai salah satu siswa berprestasi sekolah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori' => 'Motivasi & Inspiratif',
                'judul' => 'Kisah Siswa Inspiratif',
                'nama_peserta' => 'Dinda Ayu',
                'kelas' => '5B',
                'jenis_kegiatan' => 'Inspiratif',
                'tingkat' => 'Sekolah',
                'hasil' => 'Terpilih',
                'tanggal' => '2026-06-01',
                'foto' => null,
                'deskripsi' => 'Kisah siswa yang memiliki semangat belajar dan memberikan inspirasi bagi siswa lainnya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
