(() => {
    const root = document.querySelector('.school-gallery');
    if (!root) return;
    const cards = [...root.querySelectorAll('.sg-album')];
    const search = root.querySelector('#gallery-search');
    const dialog = root.querySelector('#gallery-dialog');
    const photo = root.querySelector('#gallery-photo');
    const message = root.querySelector('#gallery-photo-message');
    const previous = root.querySelector('#gallery-prev');
    const next = root.querySelector('#gallery-next');
    let photos = [];
    let position = 0;
    let request = 0;
    let scrollBefore = '';
    cards.forEach(card => {
        const cover = card.querySelector('.sg-cover img');
        if (cover) {
            const fallback = () => { cover.hidden = true; };
            cover.addEventListener('error', fallback);
            if (cover.complete && !cover.naturalWidth) fallback();
        }
        const button = card.querySelector('.sg-open');
        button.hidden = false;
        button.addEventListener('click', () => {
            root.querySelector('#gallery-dialog-title').textContent = card.querySelector('h2').textContent;
            root.querySelector('#gallery-dialog-date').textContent = card.querySelector('.sg-date').textContent;
            root.querySelector('#gallery-dialog-description').textContent = card.querySelector('.sg-description').textContent;
            photos = [...card.querySelector('template').content.querySelectorAll('[data-src]')].map(item => ({src: item.dataset.src, caption: item.dataset.caption}));
            position = 0;
            renderPhoto();
            scrollBefore = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
            dialog.showModal();
        });
    });
    function renderPhoto() {
        const currentRequest = ++request;
        photo.hidden = true;
        photo.removeAttribute('src');
        message.hidden = false;
        message.textContent = photos.length ? 'Memuat foto…' : 'Foto belum tersedia';
        previous.disabled = position === 0;
        next.disabled = position >= photos.length - 1;
        root.querySelector('#gallery-position').textContent = photos.length ? `${position + 1} / ${photos.length}` : 'Belum ada foto';
        root.querySelector('#gallery-caption').textContent = photos[position]?.caption || '';
        if (!photos.length) return;
        const item = photos[position];
        const loader = new Image();
        loader.onload = () => {
            if (currentRequest !== request) return;
            photo.src = item.src;
            photo.alt = item.caption || root.querySelector('#gallery-dialog-title').textContent;
            photo.hidden = false;
            message.hidden = true;
        };
        loader.onerror = () => {
            if (currentRequest !== request) return;
            message.textContent = 'Foto belum tersedia';
        };
        loader.src = item.src;
    }
    previous.addEventListener('click', () => { if (position > 0) { position--; renderPhoto(); } });
    next.addEventListener('click', () => { if (position < photos.length - 1) { position++; renderPhoto(); } });
    root.querySelector('#gallery-close').addEventListener('click', () => dialog.close());
    dialog.addEventListener('close', () => { request++; document.body.style.overflow = scrollBefore; });
    dialog.addEventListener('click', event => { if (event.target === dialog) dialog.close(); });
    dialog.addEventListener('keydown', event => {
        if (event.key === 'ArrowLeft') { event.preventDefault(); previous.click(); }
        if (event.key === 'ArrowRight') { event.preventDefault(); next.click(); }
    });
    search.addEventListener('input', () => {
        const query = search.value.trim().toLocaleLowerCase('id');
        let count = 0;
        cards.forEach(card => {
            card.hidden = !card.querySelector('h2').textContent.toLocaleLowerCase('id').includes(query);
            if (!card.hidden) count++;
        });
        root.querySelector('#gallery-count').textContent = `${count} album`;
        root.querySelector('#gallery-no-results').hidden = !cards.length || count > 0;
    });
})();
