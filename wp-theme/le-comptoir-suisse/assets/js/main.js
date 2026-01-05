// Le Comptoir Suisse - Enhanced Interactions
document.addEventListener('DOMContentLoaded', function() {
    
    // Hamburger Menu Toggle
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.querySelector('.mobile-menu');
    const navbar = document.querySelector('.navbar');
    
    if (hamburger) {
        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        });
    }
    
    // Mobile submenu toggle
    const submenuToggles = document.querySelectorAll('.mobile-submenu-toggle');
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const submenu = this.querySelector('.mobile-submenu');
            if (submenu) {
                submenu.classList.toggle('active');
            }
        });
    });
    
    // Close mobile menu when clicking on a link (only for anchor links, not PDFs)
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link:not(.mobile-submenu-toggle), .mobile-submenu-link');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Check if it's an anchor link (starts with #)
            if (this.getAttribute('href').startsWith('#')) {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
            // If it's a PDF link (target="_blank"), let it open in new tab
        });
    });
    
    // Navbar hide/show on scroll - DISABLED to keep navbar always visible
    /*let lastScrollTop = 0;
    const scrollThreshold = 100;
    
    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > scrollThreshold) {
            if (scrollTop > lastScrollTop) {
                // Scrolling down
                navbar.style.transform = 'translateY(-100%)';
            } else {
                // Scrolling up
                navbar.style.transform = 'translateY(0)';
            }
        } else {
            navbar.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop;
    });*/
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 80; // Account for fixed navbar
                const targetPosition = target.offsetTop - offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Parallax effect for dishes image
    window.addEventListener('scroll', function() {
        const dishesImage = document.querySelector('.dishes-image');
        if (dishesImage) {
            const rect = dishesImage.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            
            if (rect.bottom >= 0 && rect.top <= windowHeight) {
                const scrollProgress = (windowHeight - rect.top) / (windowHeight + rect.height);
                const parallaxOffset = (scrollProgress - 0.5) * 100;
                dishesImage.style.setProperty('--scroll-y', `${parallaxOffset}px`);
            }
        }
    });
    
    // Fade in animation for sections
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all sections for fade in effect
    const sections = document.querySelectorAll('.chef-section, .scrolling-gallery, .footer');
    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        observer.observe(section);
    });
    
    // Auto-scrolling gallery enhancement
    const gallery = document.querySelector('.scrolling-gallery');
    const galleryTrack = document.querySelector('.scrolling-gallery-track');
    const galleryItems = document.querySelectorAll('.scrolling-gallery-item');
    
    let scrollTimeout;
    let isUserScrolling = false;
    
    if (gallery && galleryTrack) {
        // Detect user scrolling (touch or trackpad)
        gallery.addEventListener('scroll', function() {
            if (!isUserScrolling) {
                isUserScrolling = true;
                gallery.classList.add('user-scrolling');
            }
            
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                isUserScrolling = false;
                gallery.classList.remove('user-scrolling');
            }, 2000); // Resume auto-scroll 2 seconds after user stops scrolling
        });
        
        // Pause animation on hover
        gallery.addEventListener('mouseenter', function() {
            galleryTrack.style.animationPlayState = 'paused';
        });
        
        gallery.addEventListener('mouseleave', function() {
            if (!isUserScrolling) {
                galleryTrack.style.animationPlayState = 'running';
            }
        });
    }
    
    // Lightbox functionality
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxClose = document.getElementById('lightbox-close');
    
    if (lightbox && lightboxImage && lightboxClose && galleryItems) {
        // Open lightbox when clicking on gallery item
        galleryItems.forEach(item => {
            item.addEventListener('click', function(e) {
                const imageSrc = this.getAttribute('data-image');
                if (!imageSrc) {
                    // Try to get src from img element inside
                    const img = this.querySelector('img');
                    if (img) {
                        lightboxImage.src = img.src;
                    }
                } else {
                    lightboxImage.src = imageSrc;
                }
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });
    }
    
    // Lightbox close functionality
    if (lightbox && lightboxClose) {
        // Close lightbox
        lightboxClose.addEventListener('click', function() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Close lightbox when clicking outside the image
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                lightbox.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        
        // Close lightbox with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                lightbox.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
});

// Loading animation
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
    
    // Animate hero elements on load
    const heroElements = document.querySelectorAll('.hero-logo, .reserve-button, .hero-tagline');
    heroElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        
        setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 200 + 300);
    });
});
