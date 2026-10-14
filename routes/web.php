
<?php

use Illuminate\Support\Facades\Route;

$albums = [
    'upacara-hari-guru' => [
        'judul' => 'Upacara Hari Guru',
        'kategori' => 'Kegiatan Sekolah',
        'foto' => [
            'Upacara Hari Guru/sejarah.jpg',
            
        ],
    ],

    'pengolahan-sampah' => [
        'judul' => 'Pengolahan Sampah',
        'kategori' => 'Adiwiyata',
        'foto' => [
            'Pengolahan Sampah/Acara sekolah bebas sampah plastik dan stryofoam.jpg',
            'Pengolahan Sampah/Daun kering bisa jadi hiasan dinding.jpg',
            'Pengolahan Sampah/Gaun  daur ulang dari plastik bekas.jpg',
            'Pengolahan Sampah/Kampanye Pengelolaan Sampah.jpg',
            'Pengolahan Sampah/Kirim sampah kertas ke pemulung bank sampah.jpg',
            'Pengolahan Sampah/Kirim sampah plastik ke pemulung bank sampah.jpg',
            'Pengolahan Sampah/Makan dan minum tanpa kemasan plastik sekali pakai yang dijual di kantin.jpg',
            'Pengolahan Sampah/Makan dan minum tanpa kemasan stryofoami yang dijual di kantin.jpg',
            'Pengolahan Sampah/Makan tanpa alat makan plastik.jpg',
            'Pengolahan Sampah/Makan tanpa alat makan plastik.jpg',
            'Pengolahan Sampah/Membagikan tempat sampah pilah dari botol bekas ke guru kelas.jpg',
            'Pengolahan Sampah/Membawa tempat minum dan makan guna ulang.jpg',
            'Pengolahan Sampah/Membuat loker khusus untuk pengumpulan donasi barang-barang bekas dari warga sekolah.jpg',
            'Pengolahan Sampah/Membuat tempat sampah pilah dari botol bekas.jpg',
        ],
    ],

    'konservasi-energi' => [
        'judul' => 'Konservasi Energi',
        'kategori' => 'Adiwiyata',
        'foto' => [
            'Konservasi Energi/mencabut colokan yang tidak digunakan.jpg',
            'Konservasi Energi/mematikan ac yang tidak digunakan.jpg',
            'Konservasi Energi/kampanye energi 1.jpg',
            'Konservasi Energi/KAMPANYE HEMAT ENERGI.jpg',
            'Konservasi Energi/MEMATIKAN KOMPUTER.jpg',
            'Konservasi Energi/MEMATIKAN SAKLAR LAMPU.jpg',
            'Konservasi Energi/MEMBERSIHKAN LAMPU DAN RUMAH LAMPU.jpg',
            'Konservasi Energi/MENGGANTI LAMPU LED GURU.jpg',
            'Konservasi Energi/PARKIR TANPA KENDARAAN.jpg',
            'Konservasi Energi/PENJAGA MENGGANTI LAMPU LED.jpg',
            'Konservasi Energi/SEHARI TANPA KENDARAAN BERMOTOR.jpg',

        ],
    ],

    'konservasi-air' => [
        'judul' => 'Konservasi Air',
        'kategori' => 'Adiwiyata',
        'foto' => [
            'Konservasi Air/pemanfaatan air wudhu siswa.jpg',
            'Konservasi Air/pemanfaatan limbah cuci tangan.jpg',
            'Konservasi Air/pemasangan stiker.jpg',
            'Konservasi Air/perbaikan kran sekolah.jpg',
            
        ],
    ],

    'penanaman-tanaman' => [
        'judul' => 'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman',
        'kategori' => 'Adiwiyata',
        'foto' => [
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Kegiatan menyiram tanaman oleh admin .jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Kegiatan menyiram tanaman oleh guru piket.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Kegiatan menyiram tanaman oleh petugas kantin.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Kegiatan menyiram tanaman oleh petugas kebersihan.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/menanam bersama bu lurah dan korsatpen.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Menanam bersama di kelurahan rejosari.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Menanam bersama ortu murid kls 1-6.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Menanam bersama tanaman di vas dengan media air.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Menyiram tanaman bersama.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/menyiram tanaman kader siswa.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Pemantauan green house oleh dinas pertanian.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/pemberian bibit ke warga sekitar.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/pembuatan ecoenzim dengan dlh.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/pembuatan pot tanaman dari galon bekas.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/penanaman benih cabai.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/penanaman hidroponik.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/Pengambilan bibit di dispertan.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/penyemaian benih cabai dan bayam bersama kader, pembina kader, petugas kebersihan dan koordinator penghijauan.jpg',
                'Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman/studi tiru.jpg',
                
        ],
    ],

    'kampanye-adiwiyata' => [
        'judul' => 'Kegiatan Adiwiyata Kampanye',
        'kategori' => 'Adiwiyata',
        'foto' => [
            'Kegiatan Adiwiyata Kampanye/Kampanye penanaman.jpg',
            'Kegiatan Adiwiyata Kampanye/pemakaian baju daur ulang.jpg',
            'Kegiatan Adiwiyata Kampanye/revisi drainase dan sanitasi.jpg',
            'Kegiatan Adiwiyata Kampanye/REVISI kampanye energi 4.jpg',
            'Kegiatan Adiwiyata Kampanye/REVISI kampanye konservasi air.jpg',
            'Kegiatan Adiwiyata Kampanye/REVISI kampanye konservasi air 2.jpg',
            'Kegiatan Adiwiyata Kampanye/REVISI kampanye pengelolaan sampah.jpg',
        ],
    ],

    'drainase-sanitasi' => [
        'judul' => 'Kebersihan Drainase dan Sanitasi',
        'kategori' => 'Adiwiyata',
        'foto' => [
            'Kebersihan Drainase dan Sanitasi/Pembersihan selokan dengan babinsa dan dinas pekerjaan umum.jpg',
            'Kebersihan Drainase dan Sanitasi/sosialisasi dan pembuatan biopori dengan DLH-1.jpg',
            'Kebersihan Drainase dan Sanitasi/sosialisasi dan pembuatan biopori dengan DLH.jpg',
        ],
    ],

    'pentas-seni' => [
        'judul' => 'Pentas Seni',
        'kategori' => 'Kegiatan Sekolah',
        'foto' => [
            'pentas-seni.jpg',
            ],
    ],

    'hut-kemerdekaan-ri' => [
        'judul' => 'Hari Ulang Tahun Kemerdekaan RI',
        'kategori' => 'Kegiatan Sekolah',
        'foto' => [
            'Hari Ulang Tahun Kemerdekaan RI/HUT Kemerdekaan.jpg',
            'Hari Ulang Tahun Kemerdekaan RI/walimurid.jpg',
        ],
    ],

    
    'video-pembelajaran' => [
        'judul' => 'Video Pembelajaran',
        'kategori' => 'Pembelajaran',
        'foto' => [],
        'video' => [
            '1GxLQhKu-hw',
            '53-ISyvtfgk',
        ],
    ],
];

// Route halaman utama
Route::get('/', function () use ($albums) {
    return view('galeri', [
        'albums' => $albums,
    ]);
});
