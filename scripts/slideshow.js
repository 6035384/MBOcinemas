let slideIndex = 0;

function showSlides() {
    const slides = document.querySelectorAll(".slide_content");
    slides.forEach((slide, index) => {
        slide.style.transform = `translateX(-${slideIndex * 100}%)`;
    });

    slideIndex = (slideIndex + 1) % slides.length;
}

// Zorg ervoor dat de slides opnieuw laden bij schermwijziging
function adjustSlidesOnResize() {
    const slides = document.querySelectorAll(".slide_content");
    slides.forEach((slide) => {
        slide.style.width = document.querySelector("#slideshow").offsetWidth + "px";
    });
}

// Laat de slides elke 3 seconden wisselen
setInterval(showSlides, 3000);

// Start met de eerste slide
window.onload = () => {
    showSlides();
    adjustSlidesOnResize();
};

window.onresize = adjustSlidesOnResize;
