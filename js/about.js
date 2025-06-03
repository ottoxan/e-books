
// About Page JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Add scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for scroll animation
    const animatedElements = document.querySelectorAll('.story-card, .value-card, .team-card, .contact-form-card, .info-card, .map-card');
    animatedElements.forEach(el => {
        observer.observe(el);
    });

    // Smooth scrolling for internal links (if any)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add interactive hover effects to achievement numbers
    const achievementNumbers = document.querySelectorAll('.achievement-number');
    achievementNumbers.forEach(number => {
        number.addEventListener('mouseenter', function () {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.3s ease';
        });

        number.addEventListener('mouseleave', function () {
            this.style.transform = 'scale(1)';
        });
    });

    // Add staggered animation for team cards
    const teamCards = document.querySelectorAll('.team-card');
    teamCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Add parallax effect to floating circles
    window.addEventListener('scroll', function () {
        const scrolled = window.pageYOffset;
        const parallax = scrolled * 0.5;

        const circles = document.querySelectorAll('.floating-circle');
        circles.forEach((circle, index) => {
            const speed = 0.3 + (index * 0.1);
            circle.style.transform = `translateY(${parallax * speed}px)`;
        });
    });
});
