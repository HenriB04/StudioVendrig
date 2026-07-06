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

    // Bouwanimatie: het huis tekent zichzelf op basis van de scrollpositie
    var bouwSection = document.getElementById('bouwSection');
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (bouwSection && !reducedMotion) {
        var paden = Array.prototype.slice.call(bouwSection.querySelectorAll('.huis-pad'));
        var teksten = Array.prototype.slice.call(bouwSection.querySelectorAll('.huis-fade'));
        var vlakken = bouwSection.querySelector('.huis-vlakken');
        var schetsGroep = bouwSection.querySelector('.schets-groep');
        var maatGroep = bouwSection.querySelector('.maat-groep');
        var fases = Array.prototype.slice.call(bouwSection.querySelectorAll('.bouw-fase'));
        var klaar = bouwSection.querySelector('.bouw-klaar');
        // Drempels gelijk aan de tekenfases: schets 0-30%, maatvoering 30-55%, bouw 55-100%
        var faseDrempels = [0.02, 0.30, 0.55];

        paden.forEach(function (pad) {
            var lengte = pad.getTotalLength();
            pad.dataset.lengte = lengte;
            pad.style.strokeDasharray = lengte;
            pad.style.strokeDashoffset = lengte;
        });

        function deel(voortgang, van, tot) {
            return Math.min(1, Math.max(0, (voortgang - van) / (tot - van)));
        }

        function updateBouw() {
            var rect = bouwSection.getBoundingClientRect();
            var scrollbaar = rect.height - window.innerHeight;
            var voortgang = Math.min(1, Math.max(0, -rect.top / scrollbaar));

            paden.forEach(function (pad) {
                var t = deel(voortgang, parseFloat(pad.dataset.van), parseFloat(pad.dataset.tot));
                pad.style.strokeDashoffset = pad.dataset.lengte * (1 - t);
            });

            // Maatgetallen faden in tijdens de technische uitwerking
            teksten.forEach(function (tekst) {
                tekst.setAttribute('opacity', deel(voortgang, parseFloat(tekst.dataset.van), parseFloat(tekst.dataset.tot)));
            });

            // Tijdens de bouw vervagen de schets en de maatvoering naar de achtergrond
            schetsGroep.setAttribute('opacity', 1 - 0.75 * deel(voortgang, 0.55, 0.9));
            maatGroep.setAttribute('opacity', 1 - 0.7 * deel(voortgang, 0.62, 0.9));

            // Vlakken kleuren in bij de oplevering
            vlakken.setAttribute('opacity', 0.9 * deel(voortgang, 0.93, 1));

            fases.forEach(function (fase, i) {
                fase.classList.toggle('is-active', voortgang >= faseDrempels[i]);
            });
            klaar.classList.toggle('is-zichtbaar', voortgang > 0.97);
        }

        window.addEventListener('scroll', updateBouw, { passive: true });
        window.addEventListener('resize', updateBouw, { passive: true });
        updateBouw();
    } else if (bouwSection && reducedMotion) {
        // Zonder animatie: toon het eindresultaat
        bouwSection.querySelector('.huis-vlakken').setAttribute('opacity', 0.9);
        bouwSection.querySelector('.schets-groep').setAttribute('opacity', 0.25);
        bouwSection.querySelector('.maat-groep').setAttribute('opacity', 0.3);
        bouwSection.querySelectorAll('.huis-fade').forEach(function (t) { t.setAttribute('opacity', 1); });
        bouwSection.querySelectorAll('.bouw-fase').forEach(function (f) { f.classList.add('is-active'); });
        bouwSection.querySelector('.bouw-klaar').classList.add('is-zichtbaar');
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
