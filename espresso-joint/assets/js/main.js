/**
 * Main JavaScript file for Espresso Joint theme
 */

jQuery(document).ready(function($) {
    
    // Navbar scroll effect
    function handleNavbarScroll() {
        const navbar = document.getElementById('navbar');
        if (!navbar) return;
        
        if (window.scrollY > 10) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
    
    // Mobile menu functionality
    function initMobileMenu() {
        const mobileToggle = document.getElementById('mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        
        if (!mobileToggle || !navMenu) return;
        
        mobileToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            const icon = mobileToggle.querySelector('i');
            
            if (navMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
        
        // Close mobile menu when clicking on links
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                    const icon = mobileToggle.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
        });
    }
    
    // Smooth scrolling for anchor links
    function initSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#' || href === '#!') return;
                
                e.preventDefault();
                const target = document.querySelector(href);
                
                if (target) {
                    const offsetTop = target.offsetTop - 80; // Account for fixed navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
    
    // Form validation for contact form
    function initFormValidation() {
        const contactForm = document.querySelector('form[method="post"]');
        if (!contactForm) return;
        
        contactForm.addEventListener('submit', function(e) {
            const name = this.querySelector('input[name="contact_name"]');
            const email = this.querySelector('input[name="contact_email"]');
            const message = this.querySelector('textarea[name="contact_message"]');
            
            let isValid = true;
            let errorMessage = '';
            
            // Clear previous error styles
            [name, email, message].forEach(field => {
                if (field) {
                    field.style.borderColor = '';
                }
            });
            
            // Validate name
            if (!name.value.trim()) {
                name.style.borderColor = '#dc2626';
                errorMessage += 'Name is required.\n';
                isValid = false;
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value.trim()) {
                email.style.borderColor = '#dc2626';
                errorMessage += 'Email is required.\n';
                isValid = false;
            } else if (!emailRegex.test(email.value)) {
                email.style.borderColor = '#dc2626';
                errorMessage += 'Please enter a valid email address.\n';
                isValid = false;
            }
            
            // Validate message
            if (!message.value.trim()) {
                message.style.borderColor = '#dc2626';
                errorMessage += 'Message is required.\n';
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                alert(errorMessage);
            }
        });
    }
    
    // Animate elements on scroll
    function initScrollAnimations() {
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
        
        // Elements to animate
        const animateElements = document.querySelectorAll('.loyalty-card, .menu-category, .contact-form, .info-card');
        
        animateElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    }
    
    // Loyalty card hover effects
    function initLoyaltyCardEffects() {
        const loyaltyCards = document.querySelectorAll('.loyalty-card');
        
        loyaltyCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05) translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) translateY(0)';
            });
        });
    }
    
    // Menu category click effects
    function initMenuCategoryEffects() {
        const menuCategories = document.querySelectorAll('.menu-category');
        
        menuCategories.forEach(category => {
            category.addEventListener('click', function() {
                // Add click animation
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
                
                // You can add filtering functionality here
                const categoryName = this.querySelector('h3').textContent;
                console.log('Category clicked:', categoryName);
            });
        });
    }
    
    // Button hover effects
    function initButtonEffects() {
        const buttons = document.querySelectorAll('.btn-primary, .btn-hero-primary, .btn-hero-secondary, .btn-submit');
        
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                if (!this.style.transform) {
                    this.style.transform = 'scale(1.05)';
                }
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    }
    
    // Initialize all functions
    function init() {
        // Add scroll event listener
        window.addEventListener('scroll', handleNavbarScroll);
        
        // Initialize mobile menu
        initMobileMenu();
        
        // Initialize smooth scrolling
        initSmoothScrolling();
        
        // Initialize form validation
        initFormValidation();
        
        // Initialize scroll animations
        if ('IntersectionObserver' in window) {
            initScrollAnimations();
        }
        
        // Initialize interactive effects
        initLoyaltyCardEffects();
        initMenuCategoryEffects();
        initButtonEffects();
        
        // Set initial navbar state
        handleNavbarScroll();
    }
    
    // Run initialization
    init();
    
    // Re-initialize on window resize for responsive behavior
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Re-initialize mobile menu if needed
            const navMenu = document.querySelector('.nav-menu');
            if (window.innerWidth > 768 && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                const mobileToggle = document.getElementById('mobile-menu-toggle');
                if (mobileToggle) {
                    const icon = mobileToggle.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        }, 250);
    });
    
});