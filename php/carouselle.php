<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spaceship Carousel</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: darkslateblue;
            color: white;
            font-family: Arial, sans-serif;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .banner {
            text-align: center;
            width: 80%;
            max-width: 1200px;
        }

        .bannertitle {
            font-size: 2.5em;
            font-weight: bold;
            color: #2fa8ff;
            margin-bottom: 20px;
        }

        .slider {
            position: relative;
            width: 80%;
            margin: 0 auto;
            overflow: hidden;
        }

        .slider-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .item {
            flex: 0 0 60%;
            margin: 0 1.5%;
            opacity: 0.4;
            transform: scale(0.85);
            transition: transform 0.5s, opacity 0.5s;
            position: relative;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            overflow: hidden; /* Cache la partie en dehors du conteneur */
        }

        .item.active {
            opacity: 1;
            transform: scale(1);
            z-index: 2; /* L'image active passe au premier plan */
        }

        .item img {
            width: 100%;
            border-radius: 15px;
            display: block; /* Empêche le texte de se chevaucher */
        }

        .description {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 15px;
            font-size: 1.5em;
            color: #bbb;
            border-radius: 10px;
            margin-top: 15px;
            position: absolute;
            bottom: 0; /* Positionne la description en bas */
            left: 0;
            width: 100%;
            text-align: center;
        }

        .description strong {
            font-weight: bold;
        }

        .dots {
            margin-top: 15px;
        }

        .dot {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: gray;
            margin: 5px;
            cursor: pointer;
        }

        .dot.active {
            background-color: white;
        }
    </style>
</head>
<body>
<div class="banner">
    <p class="bannertitle">Our Spacecraft</p>
    <div class="slider">
        <div class="slider-track" id="carouselTrack">
            <div class="item">
                <img src="https://www.pngkey.com/png/full/32-324067_free-spaceship-png-sci-fi-spaceship-antennas.png" alt="spaceship3">
                <div class="description">
                    <strong>Model:</strong> Quantum Cruiser<br>
                    <strong>Capacity:</strong> 500 passengers<br>
                    <strong>Speed:</strong> 0.8 light years per hour<br>
                    <strong>Features:</strong> Solar energy, Hyperspace drive, AI cockpit
                </div>
            </div>
            <div class="item">
                <img src="https://file.aiquickdraw.com/imgcompressed/img/compressed_a5c4e0956fd81026e77a51c297ee60dc.webp" alt="spaceship4">
                <div class="description">
                    <strong>Model:</strong> Nova Explorer<br>
                    <strong>Capacity:</strong> 300 passengers<br>
                    <strong>Speed:</strong> 1.2 light years per hour<br>
                    <strong>Features:</strong> Advanced shielding, Long-range communication, Anti-gravity propulsion
                </div>
            </div>
            <div class="item">
                <img src="https://file.aiquickdraw.com/imgcompressed/img/compressed_6037a48a86cf4a546694501210a81c7f.webp" alt="spaceship5">
                <div class="description">
                    <strong>Model:</strong> Alpha Voyager<br>
                    <strong>Capacity:</strong> 150 passengers<br>
                    <strong>Speed:</strong> 1.5 light years per hour<br>
                    <strong>Features:</strong> Energy-efficient, Super-fast engines, Space tourism-ready
                </div>
            </div>
            <div class="item">
                <img src="https://static.vecteezy.com/system/resources/previews/045/800/410/non_2x/spaceship-isolated-on-transparent-background-free-png.png" alt="spaceship6">
                <div class="description">
                    <strong>Model:</strong> Stellar Guardian<br>
                    <strong>Capacity:</strong> 200 passengers<br>
                    <strong>Speed:</strong> 1.0 light years per hour<br>
                    <strong>Features:</strong> Long-range lasers, Anti-pirate defense system, Luxury cabins
                </div>
            </div>
            <div class="item">
                <img src="https://www.nicepng.com/png/full/12-128122_spaceship-png-images-spaceship-png.png" alt="spaceship7">
                <div class="description">
                    <strong>Model:</strong> Lightwave Interceptor<br>
                    <strong>Capacity:</strong> 100 passengers<br>
                    <strong>Speed:</strong> 1.8 light years per hour<br>
                    <strong>Features:</strong> High-speed travel, Cloaking device, Elite stealth technology
                </div>
            </div>
            <div class="item">
                <img src="https://cdn.fleetyards.net/uploads/model/angled_view_colored/44/eb/ab77-3856-40da-9162-4774aa8c27f5/large_angled-v2-fleetchart-9642f4fa-0425-42b7-9f33-a301cd49f851.png" alt="spaceship8">
                <div class="description">
                    <strong>Model:</strong> Galactic Pioneering Ship<br>
                    <strong>Capacity:</strong> 1000 passengers<br>
                    <strong>Speed:</strong> 0.9 light years per hour<br>
                    <strong>Features:</strong> Hyperloop engine, Multi-tiered city decks, Large cargo hold
                </div>
            </div>
        </div>
    </div>
    <div class="dots" id="carouselDots"></div>
</div>

<script>
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
</script>
</body>
</html>
