<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SDN Rejosari 03')</title>

    <style>
        :root {
            --site-red: #a84450;
            --site-red-dark: #893642;
            --site-pink: #f5e7e9;
            --site-text: #263244;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #333;
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

        /* Navbar */
        .site-nav {
            padding: 12px 24px;
            background: var(--site-red);
            color: #ffffff;
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
            padding: 10px 12px;
            border-radius: 8px;
            color: #ffffff;
            font-size: 14px;
            line-height: 1.4;
            text-decoration: none;
        }

        .site-nav .site-nav__links a:hover,
        .site-nav .site-nav__links a[aria-current="page"] {
            background: var(--site-red-dark);
        }

        .site-nav a:focus-visible,
        .site-nav summary:focus-visible,
        .site-footer a:focus-visible {
            outline: 3px solid #ffffff;
            outline-offset: 3px;
        }

        .site-nav__mobile {
            display: none;
        }

        /* Footer */
        .site-footer {
            margin-top: 50px;
            border-top: 14px solid var(--site-pink);
            background: var(--site-red);
            color: #ffffff;
            line-height: 1.7;
        }

        .site-footer__inner {
            display: grid;
            grid-template-columns: 0.9fr 1.2fr 1fr;
            gap: 48px;
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 44px 24px;
        }

        .site-footer__column {
            min-width: 0;
        }

        .site-footer h2 {
            margin: 0 0 22px;
            font-size: 21px;
            line-height: 1.3;
            color: #ffffff;
        }

        .site-footer h2::after {
            content: "";
            display: block;
            width: 44px;
            height: 3px;
            margin-top: 10px;
            border-radius: 3px;
            background: #f0d6da;
        }

        .site-footer__menu {
            display: grid;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .site-footer__menu a {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            padding: 6px 0;
            color: #ffffff;
            text-decoration: none;
        }

        .site-footer__menu a:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        .site-footer address {
            margin: 0 0 22px;
            font-style: normal;
            overflow-wrap: anywhere;
        }

        .site-footer__contact {
            margin: 0 0 12px;
            overflow-wrap: anywhere;
        }

        .site-footer__contact strong {
            display: block;
        }

        .site-footer__hours {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .site-footer__hours th,
        .site-footer__hours td {
            padding: 8px 0;
            border-bottom: 1px solid rgb(255 255 255 / 22%);
            vertical-align: top;
        }

        .site-footer__hours th {
            padding-right: 16px;
            text-align: left;
            font-weight: 400;
        }

        .site-footer__hours td {
            text-align: right;
            white-space: nowrap;
        }

        .site-footer__bottom {
            padding: 16px 20px;
            background: var(--site-pink);
            color: var(--site-text);
            font-size: 12px;
            text-align: center;
        }

        .site-footer__bottom p {
            margin: 0;
        }

        @media (max-width: 900px) {
            .site-footer__inner {
                gap: 28px;
                padding: 36px 0;
            }
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
                border: 1px solid rgb(255 255 255 / 60%);
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

            .site-footer__inner {
                grid-template-columns: 1fr;
                gap: 32px;
                padding: 32px 4px;
            }

            .site-footer h2 {
                margin-bottom: 16px;
                font-size: 20px;
            }

            .site-footer__menu {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                column-gap: 16px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    @php
        $menuUtama = [
            ['path' => '/', 'label' => 'Beranda'],
            ['path' => 'guru', 'label' => 'Guru'],
            ['path' => 'siswa', 'label' => 'Siswa'],
            ['path' => 'gallery', 'label' => 'Galeri'],
            ['path' => 'berita', 'label' => 'Berita'],
            ['path' => 'pengumuman', 'label' => 'Pengumuman'],
            ['path' => 'pengaduan', 'label' => 'Pengaduan'],
            ['path' => 'kegiatan-lomba', 'label' => 'Kegiatan Lomba'],
        ];

        $jamKerja = [
            ['hari' => 'Senin – Kamis', 'jam' => '07.00 – 14.00'],
            ['hari' => 'Jumat', 'jam' => '07.00 – 11.30'],
            ['hari' => 'Sabtu', 'jam' => '07.00 – 12.00'],
            ['hari' => 'Minggu', 'jam' => 'Tutup'],
        ];
    @endphp

    <nav class="site-nav" aria-label="Navigasi utama">
        <details class="site-nav__mobile">
            <summary>
                Menu navigasi
                <span aria-hidden="true">☰</span>
            </summary>

            <div class="site-nav__links">
                @foreach ($menuUtama as $menu)
                    <a
                        href="{{ url($menu['path']) }}"
                        @if (request()->is($menu['path'])) aria-current="page" @endif>
                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </div>
        </details>

        <div class="site-nav__desktop site-nav__links">
            @foreach ($menuUtama as $menu)
                <a
                    href="{{ url($menu['path']) }}"
                    @if (request()->is($menu['path'])) aria-current="page" @endif>
                    {{ $menu['label'] }}
                </a>
            @endforeach
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer class="site-footer">
        <div class="site-footer__inner">
            <section class="site-footer__column" aria-labelledby="footer-menu">
                <h2 id="footer-menu">Menu Utama</h2>

                <ul class="site-footer__menu">
                    @foreach ($menuUtama as $menu)
                        <li>
                            <a href="{{ url($menu['path']) }}">
                                {{ $menu['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>

            <section class="site-footer__column" aria-labelledby="footer-kontak">
                <h2 id="footer-kontak">Kontak</h2>

                {{-- Alamat sementara mengikuti referensi desain kelompok. --}}
                <address>
                    <strong>SDN Rejosari 03</strong><br>
                    Jl. Tirtoyoso VI No. 10, Rejosari,<br>
                    Kec. Semarang Timur, Kota Semarang,<br>
                    Jawa Tengah 50125
                </address>

                <p class="site-footer__contact">
                    <strong>Telepon</strong>
                    Belum tersedia
                </p>

                <p class="site-footer__contact">
                    <strong>Email</strong>
                    Belum tersedia
                </p>
            </section>

            <section class="site-footer__column" aria-labelledby="footer-jam">
                <h2 id="footer-jam">Jam Kerja</h2>

                {{-- Jadwal sementara mengikuti referensi desain kelompok. --}}
                <table class="site-footer__hours" aria-labelledby="footer-jam">
                    <tbody>
                        @foreach ($jamKerja as $jadwal)
                            <tr>
                                <th scope="row">{{ $jadwal['hari'] }}</th>
                                <td>{{ $jadwal['jam'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>

        <div class="site-footer__bottom">
            <p>
                &copy; {{ date('Y') }} SDN Rejosari 03 Semarang.
                Hak cipta dilindungi.
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>