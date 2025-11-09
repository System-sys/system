///DISEÑO FOOTER


document.querySelectorAll('.typewriter').forEach(el => {
    el.addEventListener('animationend', () => {
        el.classList.add('finished');
    });
});

