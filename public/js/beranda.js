(() => {
    document.querySelectorAll('.home-media img').forEach(image => {
        const fallback = () => { image.hidden = true; };
        image.addEventListener('error', fallback);
        if (image.complete && image.naturalWidth === 0) fallback();
    });
})();
