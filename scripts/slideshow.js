let slideIndex = 0;

    function showSlides() {
        const slides = document.querySelectorAll(".slide_content");
        slides.forEach((slide, index) => {
            slide.style.transform = `translateX(-${slideIndex * 100}%)`;
        });

        slideIndex = (slideIndex + 1) % slides.length;
    }

    // Laat de slides elke 3 seconden wisselen
    setInterval(showSlides, 3000);

    // Start met de eerste slide
    window.onload = showSlides;
