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

        html, body {
            overflow-x: hidden;
            max-width: 100%;
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

        @media (max-width: 768px) {
            .container {
                width: 92%;
                margin: 20px auto;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 94%;
                margin: 16px auto;
            }
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

        /* --- Site Navigation & Brand --- */
        .site-nav {
            background: var(--site-red);
            color: #ffffff;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .site-nav__container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            min-height: 64px;
        }

        .site-nav__brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
            text-decoration: none;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .site-nav__brand:hover {
            opacity: 0.95;
        }

        .site-nav__desktop {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .site-nav__link,
        .site-nav__dropdown-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-height: 42px;
            padding: 8px 14px;
            border-radius: 8px;
            color: #ffffff;
            font-size: 14.5px;
            font-weight: 500;
            line-height: 1.4;
            text-decoration: none;
            background: transparent;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .site-nav__link:hover,
        .site-nav__dropdown-btn:hover,
        .site-nav__dropdown.is-open .site-nav__dropdown-btn {
            background: var(--site-red-dark);
        }

        .site-nav__link.is-active,
        .site-nav__dropdown-btn.is-active,
        .site-nav__link[aria-current="page"] {
            background: var(--site-red-dark);
            font-weight: 700;
            box-shadow: inset 0 -2px 0 0 #ffffff;
        }

        /* Desktop Dropdown Menu */
        .site-nav__dropdown {
            position: relative;
        }

        .site-nav__dropdown-menu {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            min-width: 220px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 12px 28px -4px rgba(0, 0, 0, 0.15), 0 6px 12px -4px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            padding: 8px;
            display: none;
            flex-direction: column;
            z-index: 200;
            opacity: 0;
            transform: translateY(-4px);
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .site-nav__dropdown.is-open .site-nav__dropdown-menu,
        .site-nav__dropdown:focus-within .site-nav__dropdown-menu {
            display: flex;
            opacity: 1;
            transform: translateY(0);
        }

        .site-nav__dropdown-menu a {
            display: block;
            padding: 10px 14px;
            border-radius: 8px;
            color: var(--site-text);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            line-height: 1.4;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .site-nav__dropdown-menu a:hover {
            background: var(--site-pink);
            color: var(--site-red-dark);
        }

        .site-nav__dropdown-menu a.is-active,
        .site-nav__dropdown-menu a[aria-current="page"] {
            background: var(--site-pink);
            color: var(--site-red-dark);
            font-weight: 700;
        }

        .site-nav__chevron {
            transition: transform 0.2s ease;
        }

        .site-nav__dropdown.is-open .site-nav__chevron,
        .site-nav__dropdown:focus-within .site-nav__chevron {
            transform: rotate(180deg);
        }

        /* Mobile Hamburger Toggle */
        .site-nav__toggle {
            display: none;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            background: transparent;
            border: none;
            color: #ffffff;
            cursor: pointer;
            border-radius: 8px;
            padding: 0;
        }

        .site-nav__toggle:hover {
            background: var(--site-red-dark);
        }

        /* --- Mobile Drawer Backdrop & Panel --- */
        .mobile-drawer-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
        }

        .mobile-drawer-backdrop.is-active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-drawer {
            position: fixed;
            top: 0;
            right: 0;
            width: min(340px, 86vw);
            height: 100vh;
            height: 100dvh;
            background: #181d24;
            z-index: 9999;
            box-shadow: -10px 0 35px rgba(0, 0, 0, 0.28);
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1);
            visibility: hidden;
            border-top-left-radius: 20px;
            overflow: hidden;
        }

        .mobile-drawer.is-active {
            transform: translateX(0);
            visibility: visible;
        }

        /* Dark header block with rounded corner matching mockup */
        .mobile-drawer__header {
            background: #181d24;
            padding: 20px 20px 18px;
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top-left-radius: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-sizing: border-box;
        }

        .mobile-drawer__header-brand {
            display: flex;
            flex-direction: column;
            gap: 2px;
            color: #ffffff;
        }

        .mobile-drawer__header-title {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.4px;
            color: #ffffff;
            margin: 0;
            line-height: 1.2;
        }

        .mobile-drawer__header-subtitle {
            font-size: 11.5px;
            color: #94a3b8;
            letter-spacing: 0.2px;
            margin: 0;
            line-height: 1.2;
        }

        .mobile-drawer__close {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #ffffff;
            cursor: pointer;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            padding: 0;
            transition: background-color 0.2s ease, transform 0.15s ease;
        }

        .mobile-drawer__close:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: scale(1.05);
        }

        .mobile-drawer__close:active {
            transform: scale(0.96);
        }

        .mobile-drawer__body {
            flex: 1;
            overflow-y: auto;
            padding: 14px 0 20px;
            overscroll-behavior: contain;
            background: #ffffff;
        }

        .mobile-drawer__menu {
            list-style: none;
            margin: 0;
            padding: 0 10px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .mobile-drawer__item {
            margin: 0;
        }

        .mobile-drawer__link,
        .mobile-drawer__accordion-btn {
            display: flex;
            align-items: center;
            width: 100%;
            min-height: 48px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #1e293b;
            font-size: 14.5px;
            font-weight: 600;
            text-decoration: none;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            font-family: inherit;
            gap: 12px;
            box-sizing: border-box;
            transition: background-color 0.18s ease, color 0.18s ease;
        }

        .mobile-drawer__link:hover,
        .mobile-drawer__accordion-btn:hover {
            background: #f8fafc;
            color: var(--site-red);
        }

        .mobile-drawer__link.is-active,
        .mobile-drawer__accordion-btn.is-active,
        .mobile-drawer__link[aria-current="page"] {
            color: var(--site-red-dark);
            background: #fdf2f4;
            font-weight: 700;
        }

        .mobile-drawer__icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            color: #475569;
            flex-shrink: 0;
            transition: color 0.18s ease;
        }

        .mobile-drawer__link:hover .mobile-drawer__icon,
        .mobile-drawer__accordion-btn:hover .mobile-drawer__icon {
            color: var(--site-red);
        }

        .mobile-drawer__link.is-active .mobile-drawer__icon,
        .mobile-drawer__accordion-btn.is-active .mobile-drawer__icon,
        .mobile-drawer__link[aria-current="page"] .mobile-drawer__icon {
            color: var(--site-red);
        }

        .mobile-drawer__text {
            flex: 1;
            letter-spacing: -0.1px;
        }

        .mobile-drawer__chevron {
            margin-left: auto;
            transition: transform 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            color: #64748b;
        }

        .mobile-drawer__accordion.is-open .mobile-drawer__chevron {
            transform: rotate(180deg);
            color: var(--site-red);
        }

        /* Tree-guided Accordion Submenu */
        .mobile-drawer__submenu-wrapper {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.26s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-drawer__accordion.is-open .mobile-drawer__submenu-wrapper {
            grid-template-rows: 1fr;
        }

        .mobile-drawer__submenu {
            overflow: hidden;
            list-style: none;
            margin: 2px 0 6px 24px;
            padding: 4px 0 4px 14px;
            border-left: 2px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .mobile-drawer__submenu-link {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 8px;
            color: #475569;
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            min-height: 38px;
            line-height: 1.35;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .mobile-drawer__submenu-link:hover {
            color: var(--site-red);
            background: #f1f5f9;
        }

        .mobile-drawer__submenu-link.is-active,
        .mobile-drawer__submenu-link[aria-current="page"] {
            color: var(--site-red-dark);
            font-weight: 700;
            background: #fdf2f4;
        }

        .mobile-drawer__footer {
            margin-top: auto;
            padding: 16px 20px;
            border-top: 1px solid #f1f5f9;
            background: #fafbfc;
            font-size: 11.5px;
            color: #64748b;
            line-height: 1.5;
        }

        .mobile-drawer__footer p {
            margin: 0;
        }

        .mobile-drawer__footer strong {
            display: block;
            color: var(--site-text);
            margin-bottom: 2px;
        }

        /* A11y Focus Styles */
        .site-nav a:focus-visible,
        .site-nav button:focus-visible,
        .site-footer a:focus-visible {
            outline: 3px solid #ffffff;
            outline-offset: 3px;
        }

        .mobile-drawer a:focus-visible,
        .mobile-drawer button:focus-visible {
            outline: 3px solid var(--site-red);
            outline-offset: 2px;
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

        /* --- Breadcrumb (Desktop Page Marker, Hidden on Mobile) --- */
        .site-breadcrumb {
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
            padding: 10px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .site-breadcrumb__container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .site-breadcrumb__list {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
            font-size: 13px;
            color: #64748b;
        }

        .site-breadcrumb__item a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .site-breadcrumb__item a:hover {
            color: var(--site-red, #a84450);
            text-decoration: underline;
        }

        .site-breadcrumb__separator {
            color: #94a3b8;
            font-size: 13px;
            user-select: none;
        }

        .site-breadcrumb__current {
            color: var(--site-text, #263244);
            font-weight: 600;
        }

        @media (max-width: 860px) {
            .site-nav__desktop {
                display: none;
            }

            .site-nav__toggle {
                display: flex;
            }

            .site-breadcrumb {
                display: none !important;
            }
        }

        @media (max-width: 768px) {

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
    @if (request()->is('admin', 'admin/*'))
        <link rel="stylesheet" href="{{ asset('css/admin-panel.css') }}">
    @endif
</head>

<body class="{{ request()->is('admin', 'admin/*') ? 'admin-page' : '' }}">
    @php
        $menuNav = [
            [
                'type' => 'link',
                'label' => 'Beranda',
                'url' => url('/'),
                'icon' => 'home',
                'is_active' => request()->is('/'),
            ],
            [
                'type' => 'dropdown',
                'label' => 'Tentang',
                'icon' => 'book',
                'is_active' => request()->is('profil', 'visi-misi', 'kontak', 'guru', 'guru/*', 'siswa', 'siswa/*'),
                'children' => [
                    ['label' => 'Profil Sekolah', 'url' => route('profil.sekolah'), 'is_active' => request()->is('profil')],
                    ['label' => 'Visi & Misi', 'url' => route('profil.visi-misi'), 'is_active' => request()->is('visi-misi')],
                    ['label' => 'Kontak', 'url' => route('profil.kontak'), 'is_active' => request()->is('kontak')],
                    ['label' => 'Guru & Tenaga Kependidikan', 'url' => route('guru.index'), 'is_active' => request()->is('guru', 'guru/*')],
                    ['label' => 'Data Siswa', 'url' => route('siswa.index'), 'is_active' => request()->is('siswa', 'siswa/*')],
                ],
            ],
            [
                'type' => 'dropdown',
                'label' => 'Informasi',
                'icon' => 'info',
                'is_active' => request()->is('berita', 'berita/*', 'pengumuman', 'pengumuman/*', 'kegiatan-lomba', 'kegiatan-lomba/*'),
                'children' => [
                    ['label' => 'Berita & Pengumuman', 'url' => route('berita.index'), 'is_active' => request()->is('berita', 'berita/*', 'pengumuman', 'pengumuman/*')],
                    ['label' => 'Kegiatan & Lomba', 'url' => route('kegiatan-lomba.index'), 'is_active' => request()->is('kegiatan-lomba', 'kegiatan-lomba/*')],
                ],
            ],
            [
                'type' => 'link',
                'label' => 'Galeri',
                'url' => route('gallery.index'),
                'icon' => 'photo',
                'is_active' => request()->is('gallery', 'gallery/*'),
            ],
            [
                'type' => 'link',
                'label' => 'Pengaduan',
                'url' => route('pengaduan.create'),
                'icon' => 'mail',
                'is_active' => request()->is('pengaduan', 'pengaduan/*'),
            ],
        ];

        $footerMenu = [
            ['label' => 'Beranda', 'url' => url('/')],
            ['label' => 'Profil Sekolah', 'url' => route('profil.sekolah')],
            ['label' => 'Visi & Misi', 'url' => route('profil.visi-misi')],
            ['label' => 'Kontak & Lokasi', 'url' => route('profil.kontak')],
            ['label' => 'Guru & Staf (GTK)', 'url' => route('guru.index')],
            ['label' => 'Data Siswa', 'url' => route('siswa.index')],
            ['label' => 'Galeri Foto', 'url' => route('gallery.index')],
            ['label' => 'Berita & Pengumuman', 'url' => route('berita.index')],
            ['label' => 'Kegiatan Lomba', 'url' => route('kegiatan-lomba.index')],
            ['label' => 'Layanan Pengaduan', 'url' => route('pengaduan.create')],
        ];

        $breadcrumbs = [];
        if (!request()->is('/') && !request()->is('admin', 'admin/*')) {
            $breadcrumbs[] = ['label' => 'Beranda', 'url' => url('/')];

            if (request()->is('profil')) {
                $breadcrumbs[] = ['label' => 'Tentang'];
                $breadcrumbs[] = ['label' => 'Profil Sekolah'];
            } elseif (request()->is('visi-misi')) {
                $breadcrumbs[] = ['label' => 'Tentang'];
                $breadcrumbs[] = ['label' => 'Visi & Misi'];
            } elseif (request()->is('kontak')) {
                $breadcrumbs[] = ['label' => 'Tentang'];
                $breadcrumbs[] = ['label' => 'Kontak'];
            } elseif (request()->is('guru', 'guru/*')) {
                $breadcrumbs[] = ['label' => 'Tentang'];
                $breadcrumbs[] = ['label' => 'Guru & Tenaga Kependidikan'];
            } elseif (request()->is('siswa', 'siswa/*')) {
                $breadcrumbs[] = ['label' => 'Tentang'];
                $breadcrumbs[] = ['label' => 'Data Siswa'];
            } elseif (request()->is('berita', 'berita/*', 'pengumuman', 'pengumuman/*')) {
                $breadcrumbs[] = ['label' => 'Informasi'];
                $breadcrumbs[] = ['label' => 'Berita & Pengumuman'];
            } elseif (request()->is('kegiatan-lomba', 'kegiatan-lomba/*')) {
                $breadcrumbs[] = ['label' => 'Informasi'];
                $breadcrumbs[] = ['label' => 'Kegiatan & Lomba'];
            } elseif (request()->is('gallery', 'gallery/*')) {
                $breadcrumbs[] = ['label' => 'Galeri Foto'];
            } elseif (request()->is('pengaduan', 'pengaduan/*')) {
                $breadcrumbs[] = ['label' => 'Layanan Pengaduan'];
            }
        }

        $jamKerja = [
            ['hari' => 'Senin – Kamis', 'jam' => '07.00 – 14.00'],
            ['hari' => 'Jumat', 'jam' => '07.00 – 11.30'],
            ['hari' => 'Sabtu', 'jam' => '07.00 – 12.00'],
            ['hari' => 'Minggu', 'jam' => 'Tutup'],
        ];

        $icons = [
            'home' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
            'book' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path><path d="M6 6h10"></path><path d="M6 10h10"></path></svg>',
            'info' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>',
            'photo' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path></svg>',
            'mail' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>',
        ];
    @endphp

    @if (request()->is('admin', 'admin/*'))
    <header class="admin-header">
        <div><strong>SDN Rejosari 03</strong><span>Panel administrasi</span></div>
        <div class="admin-header-actions">
            <a href="{{ url('/') }}">Lihat website ↗</a>
            <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">Keluar</button></form>
        </div>
    </header>
    <nav class="admin-navigation" aria-label="Navigasi admin">
        <a href="{{ route('admin.dashboard') }}" @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif>Dashboard</a>
        @foreach (['guru' => 'Guru & Staf', 'siswa' => 'Siswa', 'berita' => 'Berita', 'pengumuman' => 'Pengumuman', 'gallery' => 'Galeri', 'kegiatan-lomba' => 'Kegiatan Lomba', 'pengaduan' => 'Pengaduan'] as $resource => $label)
            <a href="{{ route('admin.'.$resource.'.index') }}" @if(request()->routeIs('admin.'.$resource.'.*')) aria-current="page" @endif>{{ $label }}</a>
        @endforeach
    </nav>
    @else
    <nav class="site-nav" aria-label="Navigasi utama">
        <div class="site-nav__container">
            <a href="{{ url('/') }}" class="site-nav__brand">
                SDN Rejosari 03
            </a>

            {{-- Desktop Navigation (Compact 5 Menu Utama dengan Dropdown) --}}
            <div class="site-nav__desktop">
                @foreach ($menuNav as $item)
                    @if ($item['type'] === 'link')
                        <a href="{{ $item['url'] }}"
                           class="site-nav__link {{ $item['is_active'] ? 'is-active' : '' }}"
                           @if ($item['is_active']) aria-current="page" @endif>
                            {{ $item['label'] }}
                        </a>
                    @elseif ($item['type'] === 'dropdown')
                        <div class="site-nav__dropdown">
                            <button type="button"
                                    class="site-nav__dropdown-btn {{ $item['is_active'] ? 'is-active' : '' }}"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                <span>{{ $item['label'] }}</span>
                                <svg class="site-nav__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div class="site-nav__dropdown-menu" role="menu">
                                @foreach ($item['children'] as $child)
                                    <a href="{{ $child['url'] }}"
                                       role="menuitem"
                                       class="{{ $child['is_active'] ? 'is-active' : '' }}"
                                       @if ($child['is_active']) aria-current="page" @endif>
                                        {{ $child['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Mobile Hamburger Button --}}
            <button type="button"
                    class="site-nav__toggle"
                    id="drawer-toggle"
                    aria-controls="mobile-nav-drawer"
                    aria-expanded="false"
                    aria-label="Buka menu navigasi">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile Backdrop --}}
    <div class="mobile-drawer-backdrop" id="drawer-backdrop" aria-hidden="true"></div>

    {{-- Mobile Drawer Panel (Sesuai Mockup Referensi, Rapi & Elegan) --}}
    <aside class="mobile-drawer" id="mobile-nav-drawer" role="dialog" aria-modal="true" aria-label="Menu navigasi mobile">
        <div class="mobile-drawer__header">
            <div class="mobile-drawer__header-brand">
                <span class="mobile-drawer__header-title">SDN Rejosari 03</span>
                <span class="mobile-drawer__header-subtitle">Menu Navigasi</span>
            </div>
            <button type="button" class="mobile-drawer__close" id="drawer-close" aria-label="Tutup menu navigasi">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="mobile-drawer__body">
            <ul class="mobile-drawer__menu">
                @foreach ($menuNav as $item)
                    @if ($item['type'] === 'link')
                        <li class="mobile-drawer__item">
                            <a href="{{ $item['url'] }}"
                               class="mobile-drawer__link {{ $item['is_active'] ? 'is-active' : '' }}"
                               @if ($item['is_active']) aria-current="page" @endif>
                                <span class="mobile-drawer__icon">{!! $icons[$item['icon']] !!}</span>
                                <span class="mobile-drawer__text">{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @elseif ($item['type'] === 'dropdown')
                        <li class="mobile-drawer__item mobile-drawer__accordion {{ $item['is_active'] ? 'is-open' : '' }}">
                            <button type="button"
                                    class="mobile-drawer__accordion-btn {{ $item['is_active'] ? 'is-active' : '' }}"
                                    aria-expanded="{{ $item['is_active'] ? 'true' : 'false' }}">
                                <span class="mobile-drawer__icon">{!! $icons[$item['icon']] !!}</span>
                                <span class="mobile-drawer__text">{{ $item['label'] }}</span>
                                <svg class="mobile-drawer__chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div class="mobile-drawer__submenu-wrapper">
                                <ul class="mobile-drawer__submenu">
                                    @foreach ($item['children'] as $child)
                                        <li>
                                            <a href="{{ $child['url'] }}"
                                               class="mobile-drawer__submenu-link {{ $child['is_active'] ? 'is-active' : '' }}"
                                               @if ($child['is_active']) aria-current="page" @endif>
                                                {{ $child['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="mobile-drawer__footer">
            <strong>SDN Rejosari 03 Semarang</strong>
            <p>Jl. Tirtoyoso VI No. 10 • NPSN: 20329037</p>
        </div>
    </aside>

    @endif

    @if (!empty($breadcrumbs))
    <div class="site-breadcrumb">
        <div class="site-breadcrumb__container">
            <nav aria-label="Breadcrumb">
                <ol class="site-breadcrumb__list">
                    @foreach ($breadcrumbs as $crumb)
                        @if ($loop->last)
                            <li class="site-breadcrumb__item site-breadcrumb__current" aria-current="page">
                                {{ $crumb['label'] }}
                            </li>
                        @else
                            <li class="site-breadcrumb__item">
                                @if (isset($crumb['url']))
                                    <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                                @else
                                    <span>{{ $crumb['label'] }}</span>
                                @endif
                            </li>
                            <li class="site-breadcrumb__separator" aria-hidden="true">›</li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
    @endif

    <div class="container">
        @yield('content')
    </div>

    @if (request()->is('admin', 'admin/*'))
        <footer class="admin-footer">SDN Rejosari 03 · Panel administrasi</footer>
    @else
    <footer class="site-footer">
        <div class="site-footer__inner">
            <section class="site-footer__column" aria-labelledby="footer-menu">
                <h2 id="footer-menu">Menu Utama</h2>

                <ul class="site-footer__menu">
                    @foreach ($footerMenu as $menu)
                        <li>
                            <a href="{{ $menu['url'] }}">
                                {{ $menu['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>

            <section class="site-footer__column" aria-labelledby="footer-kontak">
                <h2 id="footer-kontak">Kontak</h2>

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

    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Mobile Drawer Elements ---
            const drawerToggle = document.getElementById('drawer-toggle');
            const drawerClose = document.getElementById('drawer-close');
            const drawerBackdrop = document.getElementById('drawer-backdrop');
            const mobileDrawer = document.getElementById('mobile-nav-drawer');

            function openDrawer() {
                if (!mobileDrawer) return;
                mobileDrawer.classList.add('is-active');
                if (drawerBackdrop) drawerBackdrop.classList.add('is-active');
                if (drawerToggle) drawerToggle.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
                if (drawerClose) drawerClose.focus();
            }

            function closeDrawer() {
                if (!mobileDrawer) return;
                mobileDrawer.classList.remove('is-active');
                if (drawerBackdrop) drawerBackdrop.classList.remove('is-active');
                if (drawerToggle) {
                    drawerToggle.setAttribute('aria-expanded', 'false');
                    drawerToggle.focus();
                }
                document.body.style.overflow = '';
            }

            if (drawerToggle) drawerToggle.addEventListener('click', openDrawer);
            if (drawerClose) drawerClose.addEventListener('click', closeDrawer);
            if (drawerBackdrop) drawerBackdrop.addEventListener('click', closeDrawer);

            // Close with Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    if (mobileDrawer && mobileDrawer.classList.contains('is-active')) {
                        closeDrawer();
                    }
                    // Also close desktop dropdowns
                    document.querySelectorAll('.site-nav__dropdown.is-open').forEach(function (dd) {
                        dd.classList.remove('is-open');
                        const btn = dd.querySelector('.site-nav__dropdown-btn');
                        if (btn) btn.setAttribute('aria-expanded', 'false');
                    });
                }
            });

            // Mobile Accordion Toggle
            document.querySelectorAll('.mobile-drawer__accordion-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const parent = this.closest('.mobile-drawer__accordion');
                    if (parent) {
                        const isOpen = parent.classList.toggle('is-open');
                        this.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    }
                });
            });

            // Desktop Dropdown Click Toggle
            document.querySelectorAll('.site-nav__dropdown').forEach(function (dropdown) {
                const btn = dropdown.querySelector('.site-nav__dropdown-btn');
                if (!btn) return;

                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isOpen = dropdown.classList.toggle('is-open');
                    btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

                    // Close any other open dropdown
                    document.querySelectorAll('.site-nav__dropdown').forEach(function (other) {
                        if (other !== dropdown) {
                            other.classList.remove('is-open');
                            const otherBtn = other.querySelector('.site-nav__dropdown-btn');
                            if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                        }
                    });
                });
            });

            // Dismiss desktop dropdowns when clicking outside
            document.addEventListener('click', function (e) {
                if (!e.target.closest('.site-nav__dropdown')) {
                    document.querySelectorAll('.site-nav__dropdown.is-open').forEach(function (dd) {
                        dd.classList.remove('is-open');
                        const btn = dd.querySelector('.site-nav__dropdown-btn');
                        if (btn) btn.setAttribute('aria-expanded', 'false');
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
