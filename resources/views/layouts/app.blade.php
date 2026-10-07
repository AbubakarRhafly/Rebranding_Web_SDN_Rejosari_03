<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SDN Rejosari 03')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #333;
        }

        nav {
            background: #1f2937;
            padding: 15px 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        h1 {
            margin-bottom: 25px;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            background: #e5e7eb;
            border-radius: 5px;
            font-size: 13px;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            background: #1f2937;
            color: white;
            text-align: center;
        }

        .site-nav {
            padding: 12px 24px;
        }

        .site-nav__links {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .site-nav .site-nav__links a {
            display: flex;
            align-items: center;
            min-height: 44px;
            margin: 0;
            padding: 10px 12px;
            border-radius: 8px;
            line-height: 1.4;
        }

        .site-nav .site-nav__links a:hover {
            background: #374151;
            text-decoration: none;
        }

        .site-nav a:focus-visible,
        .site-nav summary:focus-visible {
            outline: 3px solid #f4cc38;
            outline-offset: 3px;
        }

        .site-nav__mobile {
            display: none;
        }

        @media (max-width: 768px) {
            .site-nav {
                padding: 10px 16px;
            }

            .site-nav__desktop {
                display: none;
            }

            .site-nav__mobile {
                display: block;
            }

            .site-nav__mobile summary {
                display: flex;
                align-items: center;
                justify-content: space-between;
                min-height: 44px;
                padding: 10px 12px;
                border: 1px solid #64748b;
                border-radius: 8px;
                color: #ffffff;
                font-weight: 700;
                cursor: pointer;
                list-style: none;
            }

            .site-nav__mobile summary::-webkit-details-marker {
                display: none;
            }

            .site-nav__mobile[open] .site-nav__links {
                display: grid;
                grid-template-columns: 1fr;
                gap: 4px;
                margin-top: 10px;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <nav class="site-nav" aria-label="Navigasi utama">
        <details class="site-nav__mobile">
            <summary>Menu navigasi <span aria-hidden="true">☰</span></summary>

            <div class="site-nav__links">
                <a href="/">Beranda</a>
                <a href="/guru">Guru</a>
                <a href="/siswa">Siswa</a>
                <a href="/gallery">Galeri</a>
                <a href="/berita">Berita</a>
                <a href="/pengumuman">Pengumuman</a>
                <a href="/pengaduan">Pengaduan</a>
                <a href="/kegiatan-lomba">Kegiatan Lomba</a>
            </div>
        </details>

        <div class="site-nav__desktop site-nav__links">
            <a href="/">Beranda</a>
            <a href="/guru">Guru</a>
            <a href="/siswa">Siswa</a>
            <a href="/gallery">Galeri</a>
            <a href="/berita">Berita</a>
            <a href="/pengumuman">Pengumuman</a>
            <a href="/pengaduan">Pengaduan</a>
            <a href="/kegiatan-lomba">Kegiatan Lomba</a>
        </div>
    </nav>

    <div class="container">

        @yield('content')

    </div>

    <footer>
        SDN Rejosari 03 Semarang
    </footer>

</body>

</html>