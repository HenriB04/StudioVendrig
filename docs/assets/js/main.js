// Studio Vendrig — interactie: navigatie, hero-slider en lightbox

document.addEventListener('DOMContentLoaded', function () {

    // Schaduw onder de header bij scrollen
    var header = document.getElementById('siteHeader');
    window.addEventListener('scroll', function () {
        header.classList.toggle('is-scrolled', window.scrollY > 10);
    }, { passive: true });

    // Mobiel menu
    var toggle = document.getElementById('navToggle');
    var nav = document.getElementById('mainNav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            toggle.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    }

    // Hero-diavoorstelling
    var slides = document.querySelectorAll('.hero-slide');
    var dots = document.querySelectorAll('.hero-dot');
    if (slides.length > 1) {
        var current = 0;
        var timer = null;

        function show(i) {
            slides[current].classList.remove('is-active');
            if (dots[current]) dots[current].classList.remove('is-active');
            current = (i + slides.length) % slides.length;
            slides[current].classList.add('is-active');
            if (dots[current]) dots[current].classList.add('is-active');
        }

        function startTimer() {
            clearInterval(timer);
            timer = setInterval(function () { show(current + 1); }, 5500);
        }

        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                show(parseInt(dot.dataset.slide, 10));
                startTimer();
            });
        });

        startTimer();
    }

    // Lightbox voor projectgalerijen
    var lightbox = document.getElementById('lightbox');
    var links = Array.prototype.slice.call(document.querySelectorAll('.gallery-link'));
    if (lightbox && links.length) {
        var img = lightbox.querySelector('img');
        var caption = lightbox.querySelector('.lightbox-caption');
        var index = 0;

        function openAt(i) {
            index = (i + links.length) % links.length;
            img.src = links[index].getAttribute('href');
            caption.textContent = links[index].dataset.caption || '';
            lightbox.hidden = false;
            document.body.style.overflow = 'hidden';
        }

        function close() {
            lightbox.hidden = true;
            document.body.style.overflow = '';
        }

        links.forEach(function (link, i) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                openAt(i);
            });
        });

        lightbox.querySelector('.lightbox-close').addEventListener('click', close);
        lightbox.querySelector('.lightbox-prev').addEventListener('click', function () { openAt(index - 1); });
        lightbox.querySelector('.lightbox-next').addEventListener('click', function () { openAt(index + 1); });
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) close();
        });
        document.addEventListener('keydown', function (e) {
            if (lightbox.hidden) return;
            if (e.key === 'Escape') close();
            if (e.key === 'ArrowLeft') openAt(index - 1);
            if (e.key === 'ArrowRight') openAt(index + 1);
        });
    }
});
