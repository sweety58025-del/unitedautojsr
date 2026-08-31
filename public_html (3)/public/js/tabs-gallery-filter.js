/**
 * Tabs & Gallery Filter - PASS E Implementation
 * Before/During/After tabs and project gallery filter functionality
 * Vanilla JavaScript with smooth transitions
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
        this.buttons.forEach(button => {
            button.addEventListener('click', (e) => this.handleTabClick(e));
            button.addEventListener('keydown', (e) => this.handleKeyboard(e));
        });
    }

    handleTabClick(e) {
        const tab = e.target.closest('.tab-button');
        if (!tab) return;

        const tabName = tab.getAttribute('data-tab');
        this.showTab(tabName);
    }

    handleKeyboard(e) {
        const buttons = Array.from(this.buttons);
        const currentIndex = buttons.indexOf(e.target);

        if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
            e.preventDefault();
            const nextIndex = (currentIndex + 1) % buttons.length;
            buttons[nextIndex].focus();
            buttons[nextIndex].click();
        } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
            e.preventDefault();
            const prevIndex = (currentIndex - 1 + buttons.length) % buttons.length;
            buttons[prevIndex].focus();
            buttons[prevIndex].click();
        }
    }

    showTab(tabName) {
        // Update buttons
        this.buttons.forEach(button => {
            if (button.getAttribute('data-tab') === tabName) {
                button.classList.add('active');
                button.setAttribute('aria-selected', 'true');
            } else {
                button.classList.remove('active');
                button.setAttribute('aria-selected', 'false');
            }
        });

        // Update content
        this.contents.forEach(content => {
            if (content.getAttribute('data-tab') === tabName) {
                content.classList.add('active');
            } else {
                content.classList.remove('active');
            }
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
        this.buttons.forEach(button => {
            button.addEventListener('click', (e) => this.handleFilterClick(e));
        });
    }

    handleFilterClick(e) {
        const category = e.target.getAttribute('data-filter');
        this.filter(category);
    }

    filter(category) {
        this.currentFilter = category;

        // Update button states
        this.buttons.forEach(button => {
            if (button.getAttribute('data-filter') === category) {
                button.classList.add('active');
                button.setAttribute('aria-pressed', 'true');
            } else {
                button.classList.remove('active');
                button.setAttribute('aria-pressed', 'false');
            }
        });

        // Filter items with animation
        this.items.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            
            if (category === 'all' || itemCategory === category) {
                item.style.display = 'block';
                item.classList.remove('hidden');
                setTimeout(() => {
                    item.style.opacity = '1';
                }, 10);
            } else {
                item.style.opacity = '0';
                setTimeout(() => {
                    item.style.display = 'none';
                    item.classList.add('hidden');
                }, 300);
            }
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Initialize all tab systems
    document.querySelectorAll('.tabs-container').forEach(container => {
        new TabSystem(container);
    });

    // Initialize all gallery filters
    document.querySelectorAll('.gallery-filter-container').forEach(container => {
        new GalleryFilter(container);
    });

    // Legacy support for onclick handlers (until all components are updated)
    window.showTab = function(event, tabName) {
        event.preventDefault();
        const container = event.target.closest('.tabs-container') || document.querySelector('.tabs-container');
        const tab = new TabSystem(container);
        tab.showTab(tabName);
    };

    window.filterGallery = function(event, category) {
        event.preventDefault();
        const container = event.target.closest('.gallery-filter-container') || document.querySelector('.gallery-filter-container');
        const gallery = new GalleryFilter(container);
        gallery.filter(category);
    };
});
