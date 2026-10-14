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
    </style>
</head>

<body>

<nav>
    <a href="/">Beranda</a>
    <a href="/guru">Guru</a>
    <a href="/siswa">Siswa</a>
    <a href="/gallery">Galeri</a>
    <a href="/berita">Berita</a>
    <a href="/pengumuman">Pengumuman</a>
    <a href="/pengaduan">Pengaduan</a>
    <a href="/kegiatan-lomba">Kegiatan Lomba</a>
</nav>

<div class="container">

    @yield('content')

</div>

<footer>
    SDN Rejosari 03 Semarang
</footer>

</body>
</html>
