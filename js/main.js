// ===============================
// PONDOK PESANTREN BABUSSALAM
// Main JavaScript - All Pages
// Version: 4.0 - Production Ready
// ===============================

(function() {
    'use strict';

    // ===============================
    // ERROR HANDLING WRAPPER
    // ===============================
    window.addEventListener('error', function(e) {
        console.error('[ERROR]', e.message, 'at', e.filename, ':', e.lineno);
    });

    window.addEventListener('unhandledrejection', function(e) {
        console.error('[PROMISE REJECTION]', e.reason);
    });

    // ===============================
    // SAFE DOM READY
    // ===============================
    document.addEventListener('DOMContentLoaded', function() {
        try {
            initializeWebsite();
        } catch (error) {
            console.error('[INIT ERROR]', error);
        }
    });

    // ===============================
    // MAIN INITIALIZATION
    // ===============================
    function initializeWebsite() {
        initHamburgerMenu();
        initDropdownMenu();
        initSmoothScroll();
        initActiveMenuHighlight();
        initScrollHeaderEffect();
        initFormValidation();
        initLazyLoadImages();
        initProgramAccordion();
        
        console.log('[SUCCESS] Babussalam Website Initialized');
        console.log('[INFO] Version 4.0 - Production Ready');
    }

    // ===============================
    // HAMBURGER MENU TOGGLE
    // ===============================
    function initHamburgerMenu() {
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');
        
        if (!hamburger || !navMenu) return;

        try {
            // Toggle mobile menu
            hamburger.addEventListener('click', function(e) {
                e.stopPropagation();
                const isActive = this.classList.toggle('active');
                navMenu.classList.toggle('active');
                
                // Accessibility
                this.setAttribute('aria-expanded', isActive);
                this.setAttribute('aria-label', isActive ? 'Tutup menu' : 'Buka menu');
                
                // Prevent body scroll when menu open
                document.body.style.overflow = isActive ? 'hidden' : '';
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('nav') && navMenu.classList.contains('active')) {
                    hamburger.classList.remove('active');
                    navMenu.classList.remove('active');
                    hamburger.setAttribute('aria-expanded', 'false');
                    document.body.style.overflow = '';
                }
            });
            
            // Close menu when clicking nav links
            const navLinks = navMenu.querySelectorAll('a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        hamburger.classList.remove('active');
                        navMenu.classList.remove('active');
                        hamburger.setAttribute('aria-expanded', 'false');
                        document.body.style.overflow = '';
                    }
                });
            });
        } catch (error) {
            console.error('[HAMBURGER ERROR]', error);
        }
    }

    // ===============================
    // DROPDOWN MENU WITH ACCESSIBILITY
    // ===============================
    function initDropdownMenu() {
        const dropdowns = document.querySelectorAll('.dropdown');
        
        if (dropdowns.length === 0) return;

        try {
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                
                if (!toggle) return;
                
                // Remove Bootstrap attributes
                toggle.removeAttribute('data-bs-toggle');
                toggle.removeAttribute('data-bs-auto-close');
                
                // Set initial ARIA attributes
                toggle.setAttribute('aria-haspopup', 'true');
                toggle.setAttribute('aria-expanded', 'false');
                
                // Click handler for mobile
                toggle.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const isActive = dropdown.classList.contains('active');
                        
                        // Close other dropdowns
                        dropdowns.forEach(other => {
                            if (other !== dropdown) {
                                other.classList.remove('active');
                                const otherToggle = other.querySelector('.dropdown-toggle');
                                if (otherToggle) {
                                    otherToggle.setAttribute('aria-expanded', 'false');
                                }
                            }
                        });
                        
                        // Toggle current dropdown
                        dropdown.classList.toggle('active');
                        toggle.setAttribute('aria-expanded', !isActive);
                    }
                });

                // Desktop hover support with keyboard navigation
                if (window.innerWidth > 768) {
                    dropdown.addEventListener('mouseenter', function() {
                        toggle.setAttribute('aria-expanded', 'true');
                    });
                    
                    dropdown.addEventListener('mouseleave', function() {
                        toggle.setAttribute('aria-expanded', 'false');
                    });
                }

                // Keyboard navigation
                toggle.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });
            
            // Close dropdown when clicking outside (mobile)
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown') && window.innerWidth <= 768) {
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.remove('active');
                        const toggle = dropdown.querySelector('.dropdown-toggle');
                        if (toggle) {
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    });
                }
            });
        } catch (error) {
            console.error('[DROPDOWN ERROR]', error);
        }
    }

    // ===============================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ===============================
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        
        if (anchorLinks.length === 0) return;

        try {
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    // Skip empty anchors or just "#"
                    if (href !== '#' && href !== '#!' && href.length > 1) {
                        const target = document.querySelector(href);
                        
                        if (target) {
                            e.preventDefault();
                            const headerOffset = 80;
                            const elementPosition = target.getBoundingClientRect().top;
                            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                            
                            window.scrollTo({
                                top: offsetPosition,
                                behavior: 'smooth'
                            });
                            
                            // Focus target for accessibility
                            target.setAttribute('tabindex', '-1');
                            target.focus();
                            
                            // Close mobile menu if open
                            const hamburger = document.querySelector('.hamburger');
                            const navMenu = document.querySelector('.nav-menu');
                            if (hamburger && navMenu) {
                                hamburger.classList.remove('active');
                                navMenu.classList.remove('active');
                                hamburger.setAttribute('aria-expanded', 'false');
                                document.body.style.overflow = '';
                            }
                        }
                    }
                });
            });
        } catch (error) {
            console.error('[SMOOTH SCROLL ERROR]', error);
        }
    }

    // ===============================
    // ACTIVE MENU BASED ON CURRENT PAGE
    // ===============================
    function initActiveMenuHighlight() {
    try {
        const currentPage =
            window.location.pathname.split('/').pop() || 'index.html';

        const menuLinks = document.querySelectorAll('.nav-menu a');

        menuLinks.forEach(link => {
            // reset dulu semua
            link.classList.remove('active');
            link.removeAttribute('aria-current');

            const linkPage = link.getAttribute('href');

            if (linkPage === currentPage) {
                link.classList.add('active');
                link.setAttribute('aria-current', 'page');

                // kalau link ada di dropdown → parent ikut aktif
                const dropdown = link.closest('.dropdown');
                if (dropdown) {
                    const toggle = dropdown.querySelector('.dropdown-toggle');
                    if (toggle) {
                        toggle.classList.add('active');
                    }
                }
            }
        });
    } catch (error) {
        console.error('[ACTIVE MENU ERROR]', error);
    }
}


    // ===============================
    // SCROLL HEADER EFFECT
    // ===============================
    function initScrollHeaderEffect() {
        const header = document.querySelector('header');
        
        if (!header) return;

        try {
            let lastScroll = 0;
            
            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll <= 0) {
                    header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                } else {
                    header.style.boxShadow = '0 4px 20px rgba(0,0,0,0.15)';
                }
                
                lastScroll = currentScroll;
            });
        } catch (error) {
            console.error('[SCROLL HEADER ERROR]', error);
        }
    }

    // ===============================
    // FORM VALIDATION WITH ACCESSIBILITY
    // ===============================
    function initFormValidation() {
        const forms = document.querySelectorAll('form');
        
        if (forms.length === 0) return;

        try {
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;
                    let firstInvalidField = null;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.style.borderColor = '#ff4444';
                            field.setAttribute('aria-invalid', 'true');
                            
                            if (!firstInvalidField) {
                                firstInvalidField = field;
                            }
                            
                            // Reset border after 3 seconds
                            setTimeout(() => {
                                field.style.borderColor = '';
                            }, 3000);
                        } else {
                            field.style.borderColor = '';
                            field.setAttribute('aria-invalid', 'false');
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                        alert('Mohon lengkapi semua field yang wajib diisi!');
                        
                        // Focus on first invalid field
                        if (firstInvalidField) {
                            firstInvalidField.focus();
                        }
                    }
                });
                
                // Real-time validation feedback
                const requiredFields = form.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    field.addEventListener('blur', function() {
                        if (!this.value.trim()) {
                            this.style.borderColor = '#ff4444';
                            this.setAttribute('aria-invalid', 'true');
                        } else {
                            this.style.borderColor = '#28a745';
                            this.setAttribute('aria-invalid', 'false');
                        }
                    });
                    
                    field.addEventListener('input', function() {
                        if (this.value.trim()) {
                            this.style.borderColor = '#28a745';
                            this.setAttribute('aria-invalid', 'false');
                        }
                    });
                });
            });
        } catch (error) {
            console.error('[FORM VALIDATION ERROR]', error);
        }
    }

    // ===============================
    // LAZY LOADING IMAGES
    // ===============================
    function initLazyLoadImages() {
        const images = document.querySelectorAll('img[data-src]');
        
        if (images.length === 0) return;

        try {
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            observer.unobserve(img);
                        }
                    });
                });
                
                images.forEach(img => imageObserver.observe(img));
            } else {
                // Fallback for browsers that don't support IntersectionObserver
                images.forEach(img => {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                });
            }
        } catch (error) {
            console.error('[LAZY LOAD ERROR]', error);
        }
    }

    // ===============================
    // PROGRAM ACCORDION
    // ===============================
    function initProgramAccordion() {
        try {
            window.toggleDefinition = function(element) {
                const parentItem = element.closest('.program-item');
                
                if (parentItem) {
                    const isActive = parentItem.classList.contains('active');
                    parentItem.classList.toggle('active');
                    
                    // Accessibility
                    const toggle = parentItem.querySelector('.toggle-btn');
                    if (toggle) {
                        toggle.setAttribute('aria-expanded', !isActive);
                    }
                }
            };
        } catch (error) {
            console.error('[ACCORDION ERROR]', error);
        }
    }

})();