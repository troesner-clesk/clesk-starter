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
});
