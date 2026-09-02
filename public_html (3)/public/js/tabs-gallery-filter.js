/**
 * Tabs & Gallery Filter + FAQ Accordion
 */

class TabSystem {
    constructor(containerSelector = '.tabs-container') {
        this.container = document.querySelector(containerSelector);
        if (!this.container) return;

        this.buttons = this.container.querySelectorAll('.tab-button');
        this.contents = document.querySelectorAll('.tab-content');
        this.attachEventListeners();
    }

    attachEventListeners() {
        this.buttons.forEach((button) => {
            button.addEventListener('click', (event) => this.handleTabClick(event));
            button.addEventListener('keydown', (event) => this.handleKeyboard(event));
        });
    }

    handleTabClick(event) {
        const tab = event.target.closest('.tab-button');
        if (!tab) return;

        this.showTab(tab.getAttribute('data-tab'));
    }

    handleKeyboard(event) {
        const buttons = Array.from(this.buttons);
        const currentIndex = buttons.indexOf(event.target);

        if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
            event.preventDefault();
            const nextIndex = (currentIndex + 1) % buttons.length;
            buttons[nextIndex].focus();
            buttons[nextIndex].click();
        } else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
            event.preventDefault();
            const prevIndex = (currentIndex - 1 + buttons.length) % buttons.length;
            buttons[prevIndex].focus();
            buttons[prevIndex].click();
        }
    }

    showTab(tabName) {
        this.buttons.forEach((button) => {
            const isActive = button.getAttribute('data-tab') === tabName;
            button.classList.toggle('active', isActive);
            button.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        this.contents.forEach((content) => {
            const isActive = content.getAttribute('data-tab') === tabName;
            content.classList.toggle('active', isActive);
        });
    }
}

class GalleryFilter {
    constructor(containerSelector = '.gallery-filter-container', gridSelector = '#galleryGrid') {
        this.container = document.querySelector(containerSelector);
        this.grid = document.querySelector(gridSelector);

        if (!this.container || !this.grid) return;

        this.buttons = this.container.querySelectorAll('.filter-btn');
        this.items = this.grid.querySelectorAll('.gallery-item');
        this.currentFilter = 'all';
        this.attachEventListeners();
    }

    attachEventListeners() {
        this.buttons.forEach((button) => {
            button.addEventListener('click', (event) => this.handleFilterClick(event));
        });
    }

    handleFilterClick(event) {
        const category = event.currentTarget.getAttribute('data-filter');
        this.filter(category);
    }

    filter(category) {
        this.currentFilter = category;

        this.buttons.forEach((button) => {
            const isActive = button.getAttribute('data-filter') === category;
            button.classList.toggle('active', isActive);
            button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        this.items.forEach((item) => {
            const itemCategory = item.getAttribute('data-category');
            const visible = category === 'all' || itemCategory === category;
            item.classList.toggle('hidden', !visible);
            item.hidden = !visible;
            item.setAttribute('aria-hidden', visible ? 'false' : 'true');
        });
    }
}

class FaqAccordion {
    constructor(selector = '.faq-accordion') {
        this.accordions = document.querySelectorAll(selector);
        this.accordions.forEach((accordion) => {
            const items = accordion.querySelectorAll('.faq-item');
            items.forEach((item) => {
                const button = item.querySelector('.faq-header');
                const panel = item.querySelector('.faq-answer');
                const icon = item.querySelector('.faq-icon');

                if (button && panel) {
                    button.setAttribute('aria-controls', panel.id || '');
                    const isOpen = item.classList.contains('open');
                    button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    panel.hidden = !isOpen;
                    if (icon) {
                        icon.textContent = isOpen ? '−' : '+';
                    }

                    button.addEventListener('click', () => {
                        const nextState = !item.classList.contains('open');

                        items.forEach((otherItem) => {
                            const otherButton = otherItem.querySelector('.faq-header');
                            const otherPanel = otherItem.querySelector('.faq-answer');
                            const otherIcon = otherItem.querySelector('.faq-icon');

                            otherItem.classList.toggle('open', false);
                            if (otherButton) otherButton.setAttribute('aria-expanded', 'false');
                            if (otherPanel) otherPanel.hidden = true;
                            if (otherIcon) otherIcon.textContent = '+';
                        });

                        item.classList.toggle('open', nextState);
                        button.setAttribute('aria-expanded', nextState ? 'true' : 'false');
                        panel.hidden = !nextState;
                        if (icon) {
                            icon.textContent = nextState ? '−' : '+';
                        }
                    });
                }
            });
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.tabs-container').forEach((container) => new TabSystem(container));
    document.querySelectorAll('.gallery-filter-container').forEach((container) => new GalleryFilter(container));
    new FaqAccordion();

    window.showTab = function (event, tabName) {
        if (event) event.preventDefault();
        const container = document.querySelector('.tabs-container');
        if (container) {
            const tab = new TabSystem('.tabs-container');
            tab.showTab(tabName);
        }
    };

    window.filterGallery = function (event, category) {
        if (event) event.preventDefault();
        const container = document.querySelector('.gallery-filter-container');
        if (container) {
            const gallery = new GalleryFilter('.gallery-filter-container', '#galleryGrid');
            gallery.filter(category);
        }
    };
});
