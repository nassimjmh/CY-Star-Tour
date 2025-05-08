<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Coming Soon | StarTour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at center, #0a0f2c 0%, #000 100%);
            font-family: 'Orbitron', sans-serif;
            color: #00fff7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            text-align: center;
        }

        .container {
            max-width: 600px;
        }

        h1 {
            font-size: 3.5rem;
            letter-spacing: 3px;
            margin-bottom: 10px;
            text-shadow: 0 0 20px #00fff7, 0 0 40px #00bfa6;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #ccc;
        }

        .countdown {
            font-size: 2rem;
            color: #ffffff;
            text-shadow: 0 0 10px #00fff7;
        }

        .glow {
            animation: pulse 2s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% {
                text-shadow: 0 0 10px #00fff7, 0 0 20px #00bfa6;
            }
            50% {
                text-shadow: 0 0 20px #00fff7, 0 0 30px #00fff7;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="glow"><img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo"></h1>
    <h2 class="glow"> COMING SOON</h2>
    <div class="countdown" id="countdown">Loading...</div>
</div>

<script>
    // Compte à rebours vers une date future (ex: 1er août 2025)
    const targetDate = new Date("2025-06-01T00:00:00").getTime();
    const countdown = document.getElementById("countdown");

    setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((distance / (1000 * 60)) % 60);
        const seconds = Math.floor((distance / 1000) % 60);

        if (distance < 0) {
            countdown.innerHTML = "🚀 Almost here!";
        } else {
            countdown.innerHTML = `${days}j ${hours}h ${minutes}m ${seconds}s`;
        }
    }, 1000);
</script>
</body>
</html>
