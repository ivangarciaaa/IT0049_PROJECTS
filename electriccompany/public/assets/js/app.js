/**
* PowerFlow Electric - Custom JavaScript
* Enhanced interactions and animations
*/
document.addEventListener('DOMContentLoaded', function () {
    // Initialize all components
    initScrollAnimations();
    initFormEnhancements();
    initLoginExperience();
    initNavigationEffects();
    initCounterAnimations();
    /**
    * Scroll-triggered animations
    */
    function initScrollAnimations() {
        const animatedElements = document.querySelectorAll('.feature-item, .card, .timeline-item');

        if (!('IntersectionObserver' in window)) {
            animatedElements.forEach(el => {
                el.style.opacity = '1';
                el.style.transform = 'none';
            });
            return;
        }

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        // Observe all animated elements
        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    }
    /**
    * Form enhancements
    */
    function initFormEnhancements() {
        // Floating labels effect
        const formInputs = document.querySelectorAll('.form-control, .form-select');
        formInputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', function () {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
        // Real-time validation feedback
        const emailInputs = document.querySelectorAll('input[type="email"]');
        emailInputs.forEach(input => {
            input.addEventListener('input', function () {
                const isValid = this.checkValidity();
                this.classList.toggle('is-valid', isValid && this.value.length > 0);
                this.classList.toggle('is-invalid', !isValid && this.value.length > 0);
            });
        });
        // Password strength indicator
        const passwordInputs = document.querySelectorAll('input[type="password"]');
        passwordInputs.forEach(input => {
            if (input.name === 'password' && input.dataset.strength !== 'off') {
                input.addEventListener('input', function () {
                    const strength = calculatePasswordStrength(this.value);
                    updatePasswordStrengthIndicator(this, strength);
                });
            }
        });
    }
    /**
    * Login-only interactions
    */
    function initLoginExperience() {
        const shell = document.querySelector('[data-login-shell]');
        if (!shell) {
            return;
        }

        const stage = shell.closest('.login-stage');
        const passwordInput = shell.querySelector('#login_password');
        const passwordToggle = shell.querySelector('[data-password-toggle]');

        if (passwordInput && passwordToggle) {
            passwordToggle.addEventListener('click', function () {
                const showingPassword = passwordInput.type === 'text';
                passwordInput.type = showingPassword ? 'password' : 'text';
                this.setAttribute('aria-pressed', String(!showingPassword));
                this.setAttribute('aria-label', showingPassword ? 'Show password' : 'Hide password');

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye', showingPassword);
                icon.classList.toggle('fa-eye-slash', !showingPassword);
                passwordInput.focus({ preventScroll: true });
            });
        }

        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const finePointer = window.matchMedia('(pointer: fine)').matches;
        if (!stage || reduceMotion || !finePointer) {
            return;
        }

        stage.addEventListener('pointermove', function (event) {
            const bounds = shell.getBoundingClientRect();
            const x = Math.max(0, Math.min(1, (event.clientX - bounds.left) / bounds.width));
            const y = Math.max(0, Math.min(1, (event.clientY - bounds.top) / bounds.height));

            shell.style.setProperty('--tilt-x', `${(0.5 - y) * 2.2}deg`);
            shell.style.setProperty('--tilt-y', `${(x - 0.5) * 2.8}deg`);
            shell.style.setProperty('--glow-x', `${x * 100}%`);
            shell.style.setProperty('--glow-y', `${y * 100}%`);
        });

        stage.addEventListener('pointerleave', function () {
            shell.style.setProperty('--tilt-x', '0deg');
            shell.style.setProperty('--tilt-y', '0deg');
            shell.style.setProperty('--glow-x', '50%');
            shell.style.setProperty('--glow-y', '50%');
        });
    }
    /**
    * Navigation effects
    */
    function initNavigationEffects() {
        const navbar = document.querySelector('.navbar');
        let lastScrollTop = 0;
        window.addEventListener('scroll', function () {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            // Add/remove scrolled class
            if (scrollTop > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            // Hide/show navbar on scroll
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                navbar.style.transform = 'translateY(-100%)';
            } else {
                navbar.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop;
        });
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const selector = this.getAttribute('href');
                if (!selector || selector === '#') {
                    return;
                }

                const target = document.querySelector(selector);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
    /**
    * Counter animations for statistics
    */
    function initCounterAnimations() {
        const counters = document.querySelectorAll('.stat-item h2');
        const counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.textContent.replace(/\D/g, ''));
                    const suffix = counter.textContent.replace(/\d/g, '');
                    animateCounter(counter, 0, target, suffix, 2000);
                    counterObserver.unobserve(counter);
                }
            });
        });
        counters.forEach(counter => {
            counterObserver.observe(counter);
        });
    }
    /**
    * Utility functions
    */
    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        return strength;
    }
    function updatePasswordStrengthIndicator(input, strength) {
        let indicator = input.parentElement.querySelector('.password-strength');
        if (!indicator) {
            indicator = document.createElement('div');
            indicator.className = 'password-strength mt-1';
            input.parentElement.appendChild(indicator);
        }
        const strengthLevels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
        const strengthColors = ['#dc3545', '#fd7e14', '#ffc107', '#20c997', '#28a745'];
        if (input.value.length === 0) {
            indicator.style.display = 'none';
            return;
        }
        indicator.style.display = 'block';
        indicator.innerHTML = `
<div class="progress" style="height: 4px;">
<div class="progress-bar" style="width: ${(strength / 5) * 100}%; background-color:
${strengthColors[strength - 1] || strengthColors[0]}"></div>
</div>
<small class="text-muted">Password strength: ${strengthLevels[strength - 1] ||
            strengthLevels[0]}</small>
`;
    }
    function animateCounter(element, start, end, suffix, duration) {
        const startTime = performance.now();
        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const current = Math.floor(start + (end - start) * easeOutQuart(progress));
            element.textContent = current + suffix;
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            }
        }
        requestAnimationFrame(updateCounter);
    }
    function easeOutQuart(t) {
        return 1 - (--t) * t * t * t;
    }
    // Loading states for forms
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                submitBtn.disabled = true;
                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            }
        });
    });
    // Enhanced tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    // Back to top button
    const backToTopBtn = document.createElement('button');
    backToTopBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
    backToTopBtn.className = 'btn btn-primary back-to-top';
    backToTopBtn.type = 'button';
    backToTopBtn.setAttribute('aria-label', 'Back to top');
    backToTopBtn.setAttribute('title', 'Back to top');
    document.body.appendChild(backToTopBtn);
    window.addEventListener('scroll', function () {
        backToTopBtn.classList.toggle('is-visible', window.pageYOffset > 300);
    });
    backToTopBtn.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    // Console welcome message
    console.log('%cPowerFlow Electric', 'color: #1e40af; font-size: 24px; font-weight: bold;');
    console.log('%cWebsite powered by CodeIgniter 4', 'color: #f59e0b; font-size: 14px;');
});
// Service Worker registration (for future PWA features)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        // navigator.serviceWorker.register('/sw.js');
    });
}
