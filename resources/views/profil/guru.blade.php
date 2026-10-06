<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Guru | SDN Rejosari 03</title>

    <link rel="stylesheet" href="{{ asset('css/profil-guru.css') }}">
</head>

<body class="profil-guru-page">
    <main class="profil-guru">
        <header class="profil-guru__intro">
            <p class="profil-guru__label">SDN REJOSARI 03</p>

            <h1>Profil Guru</h1>

            <p class="profil-guru__description">
                Mengenal guru dan tenaga kependidikan
                SDN Rejosari 03.
            </p>
        </header>

        <section aria-labelledby="judul-daftar-guru">
            <h2 id="judul-daftar-guru">Guru dan Staf</h2>

            <div class="profil-guru__grid">
                <article class="profil-guru__card">
                    <div class="profil-guru__photo-placeholder">
                        Foto Guru
                    </div>

                    <div class="profil-guru__card-content">
                        <h3>[Nama lengkap guru]</h3>
                        <p>[Jabatan / tugas mengajar]</p>
                    </div>
                </article>
            </div>
        </section>
    </main>
</body>
</html>