/**
 * Clesk Starter – Main JS
 *
 * Import CSS for Vite processing in dev mode
 */

import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
    // Transparent header scroll detection
    const header = document.querySelector('.clesk-header--transparent');
    if (header) {
        const scrollThreshold = 50;
        const onScroll = () => {
            header.classList.toggle('clesk-header--scrolled', window.scrollY > scrollThreshold);
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll(); // Check initial state
    }

    // Video play button → open modal with embedded video
    document.querySelectorAll('.clesk-video-play-btn').forEach((btn) => {
        btn.addEventListener('click', () => {
            const url = btn.dataset.videoUrl;
            if (!url) return;

            // Convert YouTube/Vimeo URLs to embed format
            let embedUrl = url;
            const ytMatch = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/);
            if (ytMatch) embedUrl = `https://www.youtube-nocookie.com/embed/${ytMatch[1]}?autoplay=1`;
            const vimeoMatch = url.match(/vimeo\.com\/(\d+)/);
            if (vimeoMatch) embedUrl = `https://player.vimeo.com/video/${vimeoMatch[1]}?autoplay=1`;

            const modal = document.createElement('div');
            modal.className = 'clesk-video-modal';
            modal.innerHTML = `<iframe src="${embedUrl}" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
            modal.addEventListener('click', (e) => {
                if (e.target === modal) modal.remove();
            });
            document.body.appendChild(modal);

            // Close on Escape
            const onEsc = (e) => {
                if (e.key === 'Escape') {
                    modal.remove();
                    document.removeEventListener('keydown', onEsc);
                }
            };
            document.addEventListener('keydown', onEsc);
        });
    });

    // Smooth scroll for same-page anchor links
    document.querySelectorAll('a[href*="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (e) => {
            const href = anchor.getAttribute('href');
            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return;

            const hash = href.substring(hashIndex + 1);
            if (!hash) return;

            // Only intercept same-page or hash-only links
            const url = new URL(href, window.location.href);
            if (url.pathname !== window.location.pathname && url.origin === window.location.origin) {
                return; // Cross-page link — let browser navigate normally
            }

            const target = document.getElementById(hash);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                history.pushState(null, null, '#' + hash);
            }
        });
    });

    // Scroll to hash target on page load (e.g. arriving from /kitchen-sink/#hero)
    if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        const target = document.getElementById(hash);
        if (target) {
            setTimeout(() => {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }
    }

    // Accordion – toggle items independently with height animation
    document.querySelectorAll('.clesk-accordion-toggle').forEach((btn) => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.clesk-accordion-item');
            const content = item.querySelector('.clesk-accordion-content');
            const iconOpen = btn.querySelector('.clesk-icon-open');
            const iconClose = btn.querySelector('.clesk-icon-close');
            const isOpen = item.classList.contains('active');

            if (isOpen) {
                content.style.height = content.scrollHeight + 'px';
                requestAnimationFrame(() => {
                    content.style.height = '0px';
                });
                content.addEventListener('transitionend', () => {
                    if (!item.classList.contains('active')) {
                        content.classList.add('hidden');
                        content.style.height = '';
                    }
                }, { once: true });
                item.classList.remove('active');
                btn.setAttribute('aria-expanded', 'false');
            } else {
                content.classList.remove('hidden');
                content.style.height = '0px';
                requestAnimationFrame(() => {
                    content.style.height = content.scrollHeight + 'px';
                });
                content.addEventListener('transitionend', () => {
                    content.style.height = '';
                }, { once: true });
                item.classList.add('active');
                btn.setAttribute('aria-expanded', 'true');
            }

            if (iconOpen) iconOpen.classList.toggle('hidden');
            if (iconClose) iconClose.classList.toggle('hidden');
        });
    });

    // Tabs – switch panels with keyboard navigation
    document.querySelectorAll('.clesk-tabs [role="tablist"]').forEach((tablist) => {
        const tabs = tablist.querySelectorAll('[role="tab"]');
        const panels = tablist.closest('.clesk-tabs').querySelectorAll('[role="tabpanel"]');

        function activateTab(tab) {
            tabs.forEach((t) => {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
                t.setAttribute('tabindex', '-1');
            });
            panels.forEach((p) => p.classList.add('hidden'));

            tab.classList.add('active');
            tab.setAttribute('aria-selected', 'true');
            tab.removeAttribute('tabindex');

            const panelId = tab.getAttribute('aria-controls');
            const panel = document.getElementById(panelId);
            if (panel) panel.classList.remove('hidden');
        }

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => activateTab(tab));
        });

        tablist.addEventListener('keydown', (e) => {
            const tabArray = Array.from(tabs);
            const currentIndex = tabArray.indexOf(document.activeElement);
            let newIndex;

            if (e.key === 'ArrowRight') newIndex = (currentIndex + 1) % tabArray.length;
            else if (e.key === 'ArrowLeft') newIndex = (currentIndex - 1 + tabArray.length) % tabArray.length;
            else if (e.key === 'Home') newIndex = 0;
            else if (e.key === 'End') newIndex = tabArray.length - 1;
            else return;

            e.preventDefault();
            tabArray[newIndex].focus();
            activateTab(tabArray[newIndex]);
        });

        tabs.forEach((tab, i) => {
            if (i > 0 && !tab.classList.contains('active')) {
                tab.setAttribute('tabindex', '-1');
            }
        });
    });
});
