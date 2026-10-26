<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Galeri Sekolah</title>

    <link rel="stylesheet" href="{{ asset('css/galeri.css') }}">
    
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>


<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">SDN REJOSARI 03</div>

    <ul class="nav-menu">
        <li>
            <a href="/">
                Home <i class="fa-solid fa-house"></i>
            </a>
        </li>
        <li>
            <a href="#">
                Tentang <i class="fa-solid fa-book-open"></i>
            </a>
        </li>
        <li>
            <a href="#">
                Information <i class="fa-solid fa-circle-info"></i>
            </a>
        </li>
        <li>
            <a href="#">
                Galeri <i class="fa-solid fa-image"></i>
            </a>
        </li>
        <li>
            <a href="#">
                Kontak <i class="fa-solid fa-envelope"></i>
            </a>
        </li>
    </ul>
</nav>



    <!-- Header Galeri -->
    <section class="gallery-header">

        <h1>Galeri Sekolah</h1>

        <p>
            Dokumentasi berbagai kegiatan dan momen sekolah.
        </p>

    </section>

    <!-- Filter Album -->
    <section class="gallery-filter">

        <div class="filter-title">
            <h2>Temukan Album</h2>
            <p>Cari dokumentasi kegiatan sekolah yang kamu inginkan.</p>
        </div>


        <div class="filter-content">
            <input
                type="text"
                id="searchAlbum"
                placeholder="Cari berdasarkan judul album..."
            >

            <select id="filterKategori">
                <option value="">Semua Kategori</option>
                <option value="kegiatan">Kegiatan Sekolah</option>
                <option value="adiwiyata">Adiwiyata</option>
                <option value="pembelajaran">Pembelajaran</option>
            </select>
        </div>

    </section>

    <!-- Daftar Album -->
    
    <section class="gallery">

        <div class="album" data-kategori="kegiatan">
            <img src="{{ asset('images\Upacara Hari Guru\sejarah.jpg') }}" alt="Upacara Hari Guru">
            <div class="album-info">
                <span>Kegiatan Sekolah</span>
                <h2>Upacara Hari Guru</h2>
                <p>Dokumentasi kegiatan Upacara Hari Guru.</p>
                <a href="#" class="buka-album" data-album="upacara-hari-guru">
                    Lihat Album →
                </a>
            </div>
        </div>

        <div class="album" data-kategori="adiwiyata">
            <img src="{{ asset('images\Pengolahan Sampah\Gaun  daur ulang dari plastik bekas.jpg') }}" alt="Pengolahan Sampah">
            <div class="album-info">
                <span>Adiwiyata</span>
                <h2>Pengolahan Sampah</h2>
                <p>Dokumentasi kegiatan pengolahan sampah.</p>
                <a href="#" class="buka-album" data-album="pengolahan-sampah">
                    Lihat Album →
                </a>
            </div>
        </div>

        <div class="album" data-kategori="adiwiyata">
            <img src="{{ asset('images\Konservasi Energi\KAMPANYE HEMAT ENERGI.jpg') }}" alt="Konservasi Energi">
            <div class="album-info">
                <span>Adiwiyata</span>
                <h2>Konservasi Energi</h2>
                <p>Dokumentasi kegiatan konservasi energi.</p>
                <a href="#" class="buka-album" data-album="konservasi-energi">
                    Lihat Album →
                </a>
            </div>
        </div>

        <div class="album" data-kategori="adiwiyata">
            <img src="{{ asset('images\Konservasi Air\pemanfaatan limbah cuci tangan.jpg') }}" alt="Konservasi Air">
            <div class="album-info">
                <span>Adiwiyata</span>
                <h2>Konservasi Air</h2>
                <p>Dokumentasi kegiatan konservasi air.</p>
                <a href="#" class="buka-album" data-album="konservasi-air">
                    Lihat Album →
                </a>
            </div>
        </div>

        <div class="album" data-kategori="adiwiyata">
            <img src="{{ asset('images\Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman\penanaman hidroponik.jpg') }}" alt="Penanaman dan Pemeliharaan Tanaman">
            <div class="album-info">
                <span>Adiwiyata</span>
                <h2>Kegiatan Adiwiyata Penanaman dan Pemeliharaan Tanaman</h2>
                <p>Dokumentasi penanaman dan pemeliharaan tanaman.</p>
                <a href="#" class="buka-album" data-album="penanaman-tanaman">
                    Lihat Album →
                </a>
            </div>
        </div>

        <div class="album" data-kategori="adiwiyata">
            <img src="{{ asset('images\kegiatan Adiwiyata kampanye\Kampanye penanaman.jpg') }}" alt="Kegiatan Adiwiyata Kampanye">
            <div class="album-info">
                <span>Adiwiyata</span>
                <h2>Kegiatan Adiwiyata Kampanye</h2>
                <p>Dokumentasi kegiatan kampanye Adiwiyata.</p>
                <a href="#" class="buka-album" data-album="kampanye-adiwiyata">
                    Lihat Album →
                </a>
            </div>
        </div>

        <div class="album" data-kategori="adiwiyata">
            <img src="{{ asset('images\Kebersihan Drainase dan Sanitasi\sosialisasi dan pembuatan biopori dengan DLH-1.jpg') }}" alt="Kebersihan Drainase dan Sanitasi">
            <div class="album-info">
                <span>Adiwiyata</span>
                <h2>Kebersihan Drainase dan Sanitasi</h2>
                <p>Dokumentasi kebersihan drainase dan sanitasi.</p>
                <a href="#" class="buka-album" data-album="drainase-sanitasi">
                    Lihat Album →
                </a>
            </div>
        </div>

        <div class="album" data-kategori="kegiatan">
            <img src="{{ asset('images\gallery_default.png') }}" alt="Pentas Seni">
            <div class="album-info">
                <span>Kegiatan Sekolah</span>
                <h2>Pentas Seni</h2>
                <p>Dokumentasi kegiatan pentas seni sekolah.</p>
                <a href="#" class="buka-album" data-album="pentas-seni">
                    Lihat Album →
                </a>
            </div>
        </div>

        <div class="album" data-kategori="kegiatan">
            <img src="{{ asset('images\Hari Ulang Tahun Kemerdekaan RI\walimurid.jpg') }}" alt="Hari Ulang Tahun Kemerdekaan RI">
            <div class="album-info">
                <span>Kegiatan Sekolah</span>
                <h2>Hari Ulang Tahun Kemerdekaan RI</h2>
                <p>Dokumentasi peringatan Hari Ulang Tahun Kemerdekaan RI.</p>
                <a href="#" class="buka-album" data-album="hut-kemerdekaan-ri">
                    Lihat Album →
                </a>
            </div>
        </div>

        <div class="album" data-kategori="pembelajaran">
            <img src="{{ asset('images\gallery_default.png') }}" alt="Video Pembelajaran">
            <div class="album-info">
                <span>Pembelajaran</span>
                <h2>Video Pembelajaran</h2>
                <p>Dokumentasi kegiatan dan media video pembelajaran.</p>
                <a href="#" class="buka-album" data-album="video-pembelajaran">
                    Lihat Album →
                </a>
            </div>
        </div>

    </section>


    <!-- Footer -->
    <footer class="school-footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Menu Utama</h3>
                <ul class="footer-menu">
                    <li><a href="/">⌂ Home</a></li>
                    <li><a href="#">◧ Tentang</a></li>
                    <li><a href="#">● Informasi</a></li>
                    <li><a href="#">▣ Galeri</a></li>
                    <li><a href="#">✉ Kontak</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Kontak</h3>
                <div class="footer-contact">
                    <p>
                        Jl. Tirt oyoso VI No.10,<br>
                        Rejosari, Kec. Semarang Tim.,<br>
                        Kota Semarang, Jawa Tengah<br>
                        50125
                    </p>
                    <p>0899999999999</p>
                    <p>Email@gmail.com</p>
                </div>
            </div>

            <div class="footer-section">
                <h3>Jam Kerja</h3>
                <div class="footer-hours">
                    <div><span>Senin - Kamis</span><span>07.00 - 14.00</span></div>
                    <div><span>Jum'at</span><span>07.00 - 11.30</span></div>
                    <div><span>Sabtu</span><span>07.00 - 12.00</span></div>
                    <div><span>Minggu</span><span>Tutup</span></div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>Copyright © 2026 SDN REJOSARI 03 All Rights Reserved.</p>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms &amp; Condition</a>
            </div>
        </div>
    </footer>

    
<script>
    // Ambil kolom pencarian dan kategori
    const searchAlbum = document.getElementById('searchAlbum');
    const filterKategori = document.getElementById('filterKategori');

    // Ambil semua kartu album
    const albums = document.querySelectorAll('.album');

    // Fungsi untuk menyaring album
    function filterAlbums() {
        const keyword = searchAlbum.value.toLowerCase().trim();
        const kategori = filterKategori.value;

        albums.forEach(function(album) {
            const judul = album.querySelector('h2').textContent.toLowerCase();
            const kategoriAlbum = album.dataset.kategori;

            const cocokJudul = judul.includes(keyword);
            const cocokKategori = kategori === '' || kategoriAlbum === kategori;

            if (cocokJudul && cocokKategori) {
                album.style.display = '';
            } else {
                album.style.display = 'none';
            }
        });
    }

    // Jalankan filter ketika pengguna mengetik atau memilih kategori
    searchAlbum.addEventListener('input', filterAlbums);
    filterKategori.addEventListener('change', filterAlbums);
</script>

<!-- Popup Galeri Album -->
<div class="album-modal" id="albumModal">

    <div class="modal-content">

        <!-- Bagian Foto -->
        <div class="modal-photo">
            <button class="modal-arrow arrow-left" id="prevPhoto">
                &#10094;
            </button>

            <img id="modalImage" src="" alt="Foto kegiatan">

            <button class="modal-arrow arrow-right" id="nextPhoto">
                &#10095;
            </button>

            <div class="photo-counter" id="photoCounter">
                1 / 1
            </div>  
            <button
                class="fullscreen-toggle"
                id="toggleFullscreen"
                type="button"
                aria-label="Tampilkan foto layar penuh"
                title="Layar penuh"
            >
                ⛶
            </button>
            

            <div id="modalVideos" class="modal-videos" style="display: none;">
                <iframe
                    id="youtubePlayer"
                    src=""
                    title="Video Pembelajaran"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>

                <div class="video-navigation">
                    <button type="button" id="prevVideo">‹ Sebelumnya</button>
                    <span id="videoCounter">1 / 2</span>
                    <button type="button" id="nextVideo">Berikutnya ›</button>
                </div>
            </div>
        </div>

        <!-- Bagian Informasi -->
        <div class="modal-info">

            <button class="modal-close" id="closeModal">
                &times;
            </button>

            <div class="school-info">
                <div class="school-logo">S</div>

                <div>
                    <h3>SDN Rejosari 03</h3>
                    <p>Galeri Sekolah</p>
                </div>
            </div>

            <div class="album-description">
                <h2 id="modalTitle">Judul Album</h2>

                <p id="modalDescription">
                    Dokumentasi kegiatan sekolah.
                </p>

                <div class="photo-total">
                    <span>SEMUA FOTO</span>
                    <span id="photoTotal">1 FOTO</span>
                </div>

                <div class="photo-thumbnails" id="photoThumbnails"></div>
            </div>

        </div>

    </div>

</div>



<script>
    const albumsData = @json($albums ?? []);

    const modal = document.getElementById('albumModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const photoCounter = document.getElementById('photoCounter');
    const photoTotal = document.getElementById('photoTotal');
    const photoThumbnails = document.getElementById('photoThumbnails');

    const modalVideos = document.getElementById('modalVideos');
    const youtubePlayer = document.getElementById('youtubePlayer');
    const videoCounter = document.getElementById('videoCounter');

    let currentPhotos = [];
    let currentVideos = [];
    let currentIndex = 0;
    let currentVideoIndex = 0;
    let isVideoAlbum = false;
    let touchStartX = 0;
    let touchEndX = 0;

    const videoIds = [
        '1GxLQhKu-hw',
        '53-ISyvtfgk'
    ];

    document.querySelectorAll('.buka-album').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const slug = this.dataset.album;
            const album = albumsData[slug];

            if (!album) {
                alert('Data album tidak ditemukan.');
                return;
            }

            isVideoAlbum = slug === 'video-pembelajaran';
            currentPhotos = album.foto || [];
            currentVideos = isVideoAlbum ? videoIds : [];
            currentIndex = 0;
            currentVideoIndex = 0;

            modalTitle.textContent = album.judul;
            modalDescription.textContent = isVideoAlbum
                ? 'Video pembelajaran dari YouTube.'
                : 'Dokumentasi kegiatan sekolah.';

            photoThumbnails.innerHTML = '';

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';

            if (isVideoAlbum) {
                modalImage.style.display = 'none';
                modalVideos.style.display = 'block';
                photoThumbnails.style.display = 'none';

                photoCounter.textContent = '';
                photoTotal.textContent = currentVideos.length + ' VIDEO';

                document.getElementById('prevPhoto').style.display = 'none';
                document.getElementById('nextPhoto').style.display = 'none';
                document.getElementById('toggleFullscreen').style.display = 'none';

                showVideo();
            } else {
                modalImage.style.display = '';
                modalVideos.style.display = 'none';
                photoThumbnails.style.display = '';

                document.getElementById('prevPhoto').style.display = '';
                document.getElementById('nextPhoto').style.display = '';
                document.getElementById('toggleFullscreen').style.display = '';

                currentPhotos.forEach(function(filename, index) {
                    const thumbnail = document.createElement('img');

                    thumbnail.src = '/images/' + filename;
                    thumbnail.alt = album.judul;

                    thumbnail.addEventListener('click', function() {
                        currentIndex = index;
                        showPhoto();
                    });

                    photoThumbnails.appendChild(thumbnail);
                });

                showPhoto();
            }
        });
    });

    function showPhoto() {
        if (currentPhotos.length === 0) {
            modalImage.removeAttribute('src');
            photoCounter.textContent = '0 / 0';
            return;
        }

        modalImage.src = '/images/' + currentPhotos[currentIndex];

        photoCounter.textContent =
            (currentIndex + 1) + ' / ' + currentPhotos.length;

        document.querySelectorAll('.photo-thumbnails img').forEach(function(img, index) {
            img.classList.toggle('active', index === currentIndex);
        });
    }

    function showVideo() {
        if (currentVideos.length === 0) return;

        youtubePlayer.src =
            'https://www.youtube.com/embed/' +
            currentVideos[currentVideoIndex];

        videoCounter.textContent =
            (currentVideoIndex + 1) + ' / ' + currentVideos.length;
    }

    document.getElementById('prevVideo').addEventListener('click', function() {
        if (!isVideoAlbum || currentVideos.length === 0) return;

        currentVideoIndex =
            (currentVideoIndex - 1 + currentVideos.length) %
            currentVideos.length;

        showVideo();
    });

    document.getElementById('nextVideo').addEventListener('click', function() {
        if (!isVideoAlbum || currentVideos.length === 0) return;

        currentVideoIndex =
            (currentVideoIndex + 1) % currentVideos.length;

        showVideo();
    });

    document.getElementById('toggleFullscreen')
        .addEventListener('click', async function() {
            const foto = document.getElementById('modalImage');

            try {
                if (document.fullscreenElement) {
                    await document.exitFullscreen();
                } else if (foto.requestFullscreen) {
                    await foto.requestFullscreen();
                }
            } catch (error) {
                alert('Mode layar penuh tidak dapat dibuka di browser ini.');
            }
        });

    document.getElementById('prevPhoto').addEventListener('click', function() {
        if (isVideoAlbum || currentPhotos.length === 0) return;

        currentIndex =
            (currentIndex - 1 + currentPhotos.length) % currentPhotos.length;

        showPhoto();
    });

    document.getElementById('nextPhoto').addEventListener('click', function() {
        if (isVideoAlbum || currentPhotos.length === 0) return;

        currentIndex = (currentIndex + 1) % currentPhotos.length;

        showPhoto();
    });

    const modalPhoto = document.querySelector('.modal-photo');

    modalPhoto.addEventListener('touchstart', function(event) {
        touchStartX = event.changedTouches[0].screenX;
    }, { passive: true });

    modalPhoto.addEventListener('touchend', function(event) {
        if (isVideoAlbum) return;

        touchEndX = event.changedTouches[0].screenX;

        const jarakGeser = touchEndX - touchStartX;

        if (Math.abs(jarakGeser) < 50 || currentPhotos.length <= 1) {
            return;
        }

        if (jarakGeser < 0) {
            currentIndex = (currentIndex + 1) % currentPhotos.length;
        } else {
            currentIndex =
                (currentIndex - 1 + currentPhotos.length) %
                currentPhotos.length;
        }

        showPhoto();
    }, { passive: true });

    function closeAlbumModal() {
        modal.classList.remove('show');
        document.body.style.overflow = '';

        // Menghentikan video saat popup ditutup
        youtubePlayer.src = '';
    }

    document.getElementById('closeModal')
        .addEventListener('click', closeAlbumModal);

    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeAlbumModal();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (!modal.classList.contains('show')) return;

        if (event.key === 'Escape') {
            closeAlbumModal();
        }

        if (isVideoAlbum) {
            if (event.key === 'ArrowLeft') {
                document.getElementById('prevVideo').click();
            }

            if (event.key === 'ArrowRight') {
                document.getElementById('nextVideo').click();
            }

            return;
        }

        if (event.key === 'ArrowLeft') {
            document.getElementById('prevPhoto').click();
        }

        if (event.key === 'ArrowRight') {
            document.getElementById('nextPhoto').click();
        }
    });
</script>
</body>
</html>