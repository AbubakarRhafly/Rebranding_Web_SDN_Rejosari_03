(() => {
    const halaman = document.querySelector('.profil-guru');

    if (!halaman) return;

    const pencarian = halaman.querySelector('.profil-guru__search');
    const input = halaman.querySelector('#cari-guru');
    const reset = halaman.querySelector('#reset-cari-guru');
    const status = halaman.querySelector('#hasil-cari-guru');
    const kosong = halaman.querySelector('#pencarian-kosong');
    const pintasan = halaman.querySelector('.profil-guru__shortcuts');

    // Halaman dengan database kosong tidak memiliki kolom pencarian.
    if (!pencarian || !input || !reset || !status || !kosong) return;

    const normalisasi = (teks) =>
        teks.toLocaleLowerCase('id-ID').trim().replace(/\s+/g, ' ');

    const kelompok = Array.from(
        halaman.querySelectorAll('section[id^="kelompok-"]')
    ).map((bagian) => ({
        bagian,
        tautan: pintasan?.querySelector(`a[href="#${bagian.id}"]`),
        kartu: Array.from(
            bagian.querySelectorAll('.profil-guru__card')
        ).map((elemen) => ({
            elemen,
            teks: normalisasi(
                `${elemen.querySelector('h3')?.textContent ?? ''} ${
                    elemen.querySelector('.profil-guru__role')?.textContent ?? ''
                }`
            ),
        })),
    }));

    const total = kelompok.reduce(
        (jumlah, item) => jumlah + item.kartu.length,
        0
    );

    function cari() {
        const kata = normalisasi(input.value).split(' ').filter(Boolean);
        let ditemukan = 0;

        kelompok.forEach(({ bagian, tautan, kartu }) => {
            let jumlahKelompok = 0;

            kartu.forEach(({ elemen, teks }) => {
                const cocok = kata.every((item) => teks.includes(item));

                elemen.hidden = !cocok;

                if (cocok) jumlahKelompok++;
            });

            bagian.hidden = jumlahKelompok === 0;

            if (tautan) {
                tautan.hidden = jumlahKelompok === 0;

                const angka = tautan.querySelector('span');
                if (angka) angka.textContent = jumlahKelompok;
            }

            ditemukan += jumlahKelompok;
        });

        kosong.hidden = ditemukan > 0;

        if (pintasan) pintasan.hidden = ditemukan === 0;

        status.textContent = `Menampilkan ${ditemukan} dari ${total} data guru dan staf.`;
        reset.disabled = input.value.length === 0;
    }

    input.addEventListener('input', cari);

    reset.addEventListener('click', () => {
        input.value = '';
        cari();
        input.focus();
    });

    pencarian.hidden = false;
    cari();
})();