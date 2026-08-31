/**
 * Hero Slider - PASS C Implementation
 * Auto-advance carousel with prev/next controls, dot indicators, and keyboard navigation
 * Vanilla JavaScript, no dependencies required
 */

class HeroSlider {
    constructor(containerSelector = '.hero-slider') {
        this.container = document.querySelector(containerSelector);
        if (!this.container) return;

        this.slides = this.container.querySelectorAll('.hero-slide');
        this.prevBtn = this.container.querySelector('.hero-prev');
        this.nextBtn = this.container.querySelector('.hero-next');
        this.dotsContainer = this.container.querySelector('.hero-dots');

        this.currentSlide = 0;
        this.autoPlayInterval = null;
        this.autoPlayDelay = 6000; // 6 seconds
        this.transitionDuration = 500; // 500ms

        this.init();
    }

    init() {
        this.createDots();
        this.attachEventListeners();
        this.showSlide(0);
        this.startAutoPlay();
    }

    createDots() {
        if (!this.dotsContainer) return;

        this.dotsContainer.innerHTML = '';
        this.slides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.className = `hero-dot ${index === 0 ? 'active' : ''}`;
            dot.setAttribute('aria-label', `Go to slide ${index + 1}`);
            dot.onclick = () => this.goToSlide(index);
            this.dotsContainer.appendChild(dot);
        });

        this.dots = this.dotsContainer.querySelectorAll('.hero-dot');
    }

    attachEventListeners() {
        if (this.prevBtn) this.prevBtn.onclick = () => this.prevSlide();
        if (this.nextBtn) this.nextBtn.onclick = () => this.nextSlide();

        this.container.addEventListener('mouseenter', () => this.pauseAutoPlay());
        this.container.addEventListener('mouseleave', () => this.startAutoPlay());

        document.addEventListener('keydown', (e) => this.handleKeyboard(e));

        // Touch support
        let touchStartX = 0;
        this.container.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
        });
        this.container.addEventListener('touchend', (e) => {
            const touchEndX = e.changedTouches[0].clientX;
            if (touchStartX - touchEndX > 50) this.nextSlide();
            if (touchEndX - touchStartX > 50) this.prevSlide();
        });
    }

    showSlide(index) {
        if (index >= this.slides.length) this.currentSlide = 0;
        if (index < 0) this.currentSlide = this.slides.length - 1;

        this.slides.forEach((slide, i) => {
            slide.classList.remove('active');
            slide.style.opacity = '0';
            slide.style.visibility = 'hidden';
        });

        this.slides[this.currentSlide].classList.add('active');
        this.slides[this.currentSlide].style.opacity = '1';
        this.slides[this.currentSlide].style.visibility = 'visible';

        if (this.dots) {
            this.dots.forEach(dot => dot.classList.remove('active'));
            this.dots[this.currentSlide].classList.add('active');
        }
    }

    nextSlide() {
        this.currentSlide++;
        if (this.currentSlide >= this.slides.length) this.currentSlide = 0;
        this.showSlide(this.currentSlide);
        this.resetAutoPlay();
    }

    prevSlide() {
        this.currentSlide--;
        if (this.currentSlide < 0) this.currentSlide = this.slides.length - 1;
        this.showSlide(this.currentSlide);
        this.resetAutoPlay();
    }

    goToSlide(index) {
        this.currentSlide = index;
        this.showSlide(this.currentSlide);
        this.resetAutoPlay();
    }

    startAutoPlay() {
        this.autoPlayInterval = setInterval(() => {
            this.currentSlide++;
            if (this.currentSlide >= this.slides.length) this.currentSlide = 0;
            this.showSlide(this.currentSlide);
        }, this.autoPlayDelay);
    }

    pauseAutoPlay() {
        clearInterval(this.autoPlayInterval);
    }

    resetAutoPlay() {
        this.pauseAutoPlay();
        this.startAutoPlay();
    }

    handleKeyboard(e) {
        if (e.key === 'ArrowLeft') this.prevSlide();
        if (e.key === 'ArrowRight') this.nextSlide();
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    new HeroSlider('.hero-slider');
});
