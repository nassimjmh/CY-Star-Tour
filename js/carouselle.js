const track = document.getElementById('carouselTrack');
const slides = document.querySelectorAll('.item');
const dotsContainer = document.getElementById('carouselDots');
let currentSlide = 0;

slides.forEach((_, index) => {
    const dot = document.createElement('span');
    dot.classList.add('dot');
    if (index === 0) dot.classList.add('active');
    dot.addEventListener('click', () => goToSlide(index));
    dotsContainer.appendChild(dot);
});

const dots = document.querySelectorAll('.dot');

function updateCarousel() {
    const slideWidth = slides[0].offsetWidth + 24; // ajusté selon le nouveau margin
    const offset = (track.offsetWidth - slideWidth) / 2; // Pour centrer l'image principale
    track.style.transform = `translateX(${-slideWidth * currentSlide + offset}px)`;

    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === currentSlide);
        dots[i].classList.toggle('active', i === currentSlide);
    });
}

function goToSlide(index) {
    currentSlide = index;
    updateCarousel();
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    updateCarousel();
}

let autoSlide = setInterval(nextSlide, 2500);

// Allow click on image to pause autoplay
track.addEventListener('mouseover', () => clearInterval(autoSlide));
track.addEventListener('mouseout', () => autoSlide = setInterval(nextSlide, 4000));

updateCarousel();
