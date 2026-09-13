/**
 * Hero Parallax
 * Scroll-linked transform on the tunnel/steering-wheel background and the
 * floating car so they move at different speeds (classic multi-layer
 * parallax "driving into a tunnel" effect). rAF-throttled, no deps.
 */
(function startHeroParallax() {
    var hero = document.querySelector('.hero-parallax');
    if (!hero) {
        document.addEventListener('DOMContentLoaded', startHeroParallax, { once: true });
        return;
    }

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduceMotion) return;

    var tunnel = hero.querySelector('.hero-parallax__tunnel');
    var car = hero.querySelector('.hero-parallax__car');
    var stats = hero.querySelector('.hero-parallax__stats');
    var headlights = car ? car.querySelector('.hero-parallax__headlights') : null;

    var SPEED_TUNNEL = 0.15;
    var SPEED_CAR = 0.12;
    var SPEED_STATS = -0.05;
    var CENTER_TOLERANCE = 56;
    var headlightsArmed = true;

    var ticking = false;

    function update() {
        var rect = hero.getBoundingClientRect();
        if (rect.bottom > 0 && rect.top < window.innerHeight) {
            var scrolled = -rect.top;
            if (tunnel) tunnel.style.transform = 'translate3d(0,' + (scrolled * SPEED_TUNNEL) + 'px,0)';
            if (car) car.style.transform = 'translate3d(-50%,' + (scrolled * SPEED_CAR * -1) + 'px,0)';
            if (stats) stats.style.transform = 'translate3d(0,' + (scrolled * SPEED_STATS) + 'px,0)';

            if (car && headlights) {
                var carRect = car.getBoundingClientRect();
                var carCenter = carRect.top + (carRect.height / 2);
                var viewportCenter = window.innerHeight / 2;
                var atViewportCenter = Math.abs(carCenter - viewportCenter) <= CENTER_TOLERANCE;

                if (atViewportCenter && headlightsArmed) {
                    car.classList.remove('headlights-flash');
                    void car.offsetWidth;
                    car.classList.add('headlights-flash');
                    headlightsArmed = false;
                } else if (!atViewportCenter) {
                    headlightsArmed = true;
                }
            }
        }
        ticking = false;
    }

    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(update);
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    update();

    var counters = hero.querySelectorAll('.hero-parallax__stat-value[data-count]');
    if (!counters.length) return;

    var counted = false;
    function triggerCount() {
        if (counted) return;
        var heroRect = hero.getBoundingClientRect();
        if (heroRect.top > window.innerHeight * 0.85) return;
        counted = true;

        counters.forEach(function (el) {
            var target = parseInt(el.getAttribute('data-count'), 10) || 0;
            if (window.Odometer) {
                var od = new window.Odometer({ el: el, value: 0, format: '(,ddd)' });
                requestAnimationFrame(function () { od.update(target); });
            } else {
                var start = 0;
                var duration = 1400;
                var startTime = performance.now();
                (function tick(now) {
                    var progress = Math.min((now - startTime) / duration, 1);
                    el.textContent = Math.floor(start + (target - start) * progress).toLocaleString();
                    if (progress < 1) requestAnimationFrame(tick);
                })(startTime);
            }
        });
    }

    window.addEventListener('scroll', triggerCount, { passive: true });
    triggerCount();
})();
