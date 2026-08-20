import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';

Alpine.plugin(persist);
window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    // ===== Preloader =====
    const preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.style.opacity = '0';
            preloader.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        }, 500);
    }

    // ===== Sticky Header =====
    const header = document.querySelector('header');

    // ===== Scroll To Top Button =====
    const scrollBtn = document.getElementById('scroll-to-top');

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;

        // Sticky header
        if (header) {
            if (scrollY > 20) {
                header.style.boxShadow = '0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1)';
                header.style.backdropFilter = 'blur(8px)';
                header.style.backgroundColor = 'rgba(255,255,255,0.95)';
            } else {
                header.style.boxShadow = '';
                header.style.backdropFilter = '';
                header.style.backgroundColor = '';
            }
        }

        // Scroll to top button
        if (scrollBtn) {
            if (scrollY > 300) {
                scrollBtn.style.opacity = '1';
                scrollBtn.style.transform = 'translateY(0)';
                scrollBtn.style.pointerEvents = 'auto';
            } else {
                scrollBtn.style.opacity = '0';
                scrollBtn.style.transform = 'translateY(16px)';
                scrollBtn.style.pointerEvents = 'none';
            }
        }
    });

    // ===== Scroll Reveal =====
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1, rootMargin: '0px 0px -40px 0px' }
    );

    document.querySelectorAll('.scroll-reveal').forEach((el) => {
        revealObserver.observe(el);
    });
});
