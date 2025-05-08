<?php
session_start();
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
    header('location: login.php');
}
//Ouvrir le bon fichier
if (isset($_GET['planet'])) {
    $selectedPlanet = $_GET['planet'];
} else {
    header("Location: map.php");
    exit;
}
$file = '../json/destination/' . ucfirst($selectedPlanet) . '.json';
if (file_exists($file)) {
    $planet = json_decode(file_get_contents($file), true);
} else {
    header("Location: map.php");
}
$filePath = '../json/data/booking.json';
?>

<!DOCTYPE html>
<html>
<head>
    <title>StarTour - <?php echo htmlspecialchars($planet['name'], ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../css/destination.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<script src="../js/destination.js"></script>

<body id="Book">
    <header>
        <?php include("navbar.php") ?>
    </header>
    <div class="rsearch noclick" style="background-image: url('<?php echo htmlspecialchars($planet['image'], ENT_QUOTES, 'UTF-8'); ?>');">
        <div class="title">
            <p><?php echo htmlspecialchars($planet['name'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </div>
    <div class="presentation">
        <p class="presentationtitle">Presentation</p>
        <p class="presentationdescription"><?php echo htmlspecialchars_decode($planet['presentation'], ENT_QUOTES); ?></p>
    </div>
    <div class="banner">
        <div class="slider">
            <div class="slider-track" id="carouselTrack">
                <?php foreach ($planet['img'] as $imageUrl): ?>
                    <div class="item">
                        <img src="<?php echo htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="landscape" loading="lazy">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="dots" id="carouselDots"></div>
    </div>
    <div class="schedule">
        <p class="presentationtitle">Schedule</p>
    </div>
    <div class="container">
        <div class="nav-bar">
            <?php
            $sub_schedule = array_slice($planet['schedule'], 1, 4);
            foreach ($sub_schedule as $index => $day): ?>
                <div class="nav-item"
                    data-title1="<?php echo htmlspecialchars($day['title1'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-description1="<?php echo htmlspecialchars($day['description1'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-title2="<?php echo htmlspecialchars($day['title2'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-description2="<?php echo htmlspecialchars($day['description2'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-map="">
                    Day <?php echo $index + 1; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-container">
            <div class="content-text" id="display-text">
                <div id="title1"></div>
                <div id="description1"></div>
                <div id="title2"></div>
                <div id="description2"></div>
            </div>
        </div>
    </div>
    <div class="reserve">
        <p class="reservetitle">Book</p>
        <form action="recap.php?planet=<?php echo ucfirst($selectedPlanet); ?>" method="post">
            <div class="slide-container">
                <!-- Group 1 -->
                <div class="group active">
                    <label class="titlerese noclick"> <h3>Total number of travelers</h3> </label>
                    <div class="radio-row">
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/2635/2635409.png" alt="1">
                            <label>1</label>
                            <input type="radio" name="nb" value="1" id="rday1" checked>
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/554/554795.png" alt="2">
                            <label>2</label>
                            <input type="radio" name="nb" value="2" id="rday2">
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/5065/5065003.png" alt="3">
                            <label>3</label>
                            <input type="radio" name="nb" value="3" id="rday3">
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/3790/3790347.png" alt="4">
                            <label>4</label>
                            <input type="radio" name="nb" value="4" id="rday4">
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/2640/2640788.png" alt="5">
                            <label>5</label>
                            <input type="radio" name="nb" value="5" id="rday5">
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/8738/8738617.png" alt="6">
                            <label>6</label>
                            <input type="radio" name="nb" value="6" id="rday6">
                        </div>
                    </div>
                </div>
                <!-- Group 2 -->
                <div class="group">
                    <label class="titlerese noclick"> <h3>Choose your program</h3> </label>
                    <div class="radio-row">
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/7123/7123303.png" alt="1">
                            <label>Day 1</label>
                            <input type="checkbox"  name="days[]" value="1">
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/7123/7123447.png" alt="2">
                            <label>Day 2</label>
                            <input type="checkbox"  name="days[]" value="2">
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/7123/7123650.png" alt="3">
                            <label>Day 3</label>
                            <input type="checkbox"  name="days[]" value="3">
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/7123/7123677.png" alt="4">
                            <label>Day 4</label>
                            <input type="checkbox"  name="days[]" value="4">
                        </div>
                    </div>
                </div>
                <!-- Group 3 -->
                <div class="group">
                    <label class="titlerese noclick"> <h3>Select the travel quality</h3> </label>
                    <div class="radio-row">
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/765/765093.png" alt="Premium">
                            <label>Premium</label>
                            <input type="radio"  name="quality" value="Premium" required>
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/186/186300.png" alt="Standard">
                            <label>Standard</label>
                            <input type="radio"  name="quality" value="Standard" required>
                        </div>
                    </div>
                </div>
                <!-- Group 4 -->
                <div class="group">
                    <label class="titlerese noclick"> <h3>Breakfast included</h3> </label>
                    <div class="radio-row">
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/887/887359.png" alt="yes">
                            <label>Yes</label>
                            <input type="radio"  name="Breakfast" value="Yes" required>
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/3241/3241035.png" alt="no">
                            <label>No</label>
                            <input type="radio"  name="Breakfast" value="No" required>
                        </div>
                    </div>
                </div>
                <!-- Group 5 -->
                <div class="group">
                    <label class="titlerese noclick"> <h3>Zero gravity relaxation</h3> </label>
                    <div class="radio-row">
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/12525/12525098.png" alt="yes">
                            <label>Yes</label>
                            <input type="radio"  name="Relax" value="Yes" required>
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/7370/7370427.png" alt="no">
                            <label>No</label>
                            <input type="radio"  name="Relax" value="No" required>
                        </div>
                    </div>
                </div>
                <!-- Group 6 -->
                <div class="group">
                    <label class="titlerese noclick"> <h3>Cancellation insurance</h3> </label>
                    <div class="radio-row">
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/1533/1533913.png" alt="yes">
                            <label>Yes</label>
                            <input type="radio"  name="insurance" value="Yes" required>
                        </div>
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/128/1533/1533919.png" alt="no">
                            <label>No</label>
                            <input type="radio"  name="insurance" value="No" required>
                        </div>
                    </div>
                </div>
                <!-- Group 7 -->
                <div class="group">
                    <label class="titlerese noclick"> <h3>Select the day</h3> </label>
                    <div class="radio-row">
                        <?php foreach ($planet['date'] as $index => $date): ?>
                            <div class="groupdays">
                                <label>Departure <br></label>
                                <p> <?php echo htmlspecialchars($date['depart'], ENT_QUOTES, 'UTF-8'); ?> </p>
                                <label>Arrival <br></label>
                                <p><?php echo htmlspecialchars($date['arrive'], ENT_QUOTES, 'UTF-8'); ?> </p>
                                <label>Price <br></label>
                                <p> <?php echo htmlspecialchars($date['prix'], ENT_QUOTES, 'UTF-8'); ?> ₴ </p>
                                <input type="radio" name="date" value="<?php echo $index; ?>" required>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="radio-row">
                        <button class="navigation-button" type="submit" name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>

        <div id="error-message" class="error-message"></div>

        <div class="group2">
            <button type="button" id="suivantBtn" class="navigation-button">Next</button>
            <button type="button" id="prevButton" class="navigation-button">Back</button>
        </div>
        <div class="group2">
            <p>Estimated price : <span id="price-estimate">0 ₴</span></p>
        </div>
    </div>
    <!--FOOTER-->
    <?php include("footer.php") ?>
</body>

<script src="../js/destination.js"></script>

<!--Il dois rester ici-->
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

    let autoSlide = setInterval(nextSlide, 3000);

    // Allow click on image to pause autoplay
    track.addEventListener('mouseover', () => clearInterval(autoSlide));
    track.addEventListener('mouseout', () => autoSlide = setInterval(nextSlide, 4000));

    updateCarousel();
</script>

</html>
