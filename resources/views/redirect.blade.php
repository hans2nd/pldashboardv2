<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;url=https://dashboard.panganlestari.id/">
    <title>Site Dipindahkan - PL Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1e3a5f 0%, #0d1b2a 100%);
            color: #fff;
            padding: 20px;
        }

        .container {
            text-align: center;
            max-width: 600px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            margin-bottom: 30px;
        }

        .logo {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo svg {
            width: 60px;
            height: 60px;
            fill: #4ade80;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #4ade80;
        }

        .message {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.9);
        }

        .new-url {
            background: rgba(74, 222, 128, 0.15);
            border: 1px solid rgba(74, 222, 128, 0.3);
            border-radius: 12px;
            padding: 20px 30px;
            margin-bottom: 30px;
        }

        .new-url-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .new-url a {
            color: #4ade80;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 600;
            word-break: break-all;
        }

        .new-url a:hover {
            text-decoration: underline;
        }

        .countdown {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 25px;
        }

        .countdown span {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            padding: 5px 12px;
            border-radius: 6px;
            font-weight: 600;
            color: #fff;
            min-width: 35px;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #4ade80, #22c55e);
            color: #0d1b2a;
            padding: 14px 40px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(74, 222, 128, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 222, 128, 0.4);
        }

        .footer {
            margin-top: 40px;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.5rem;
            }

            .message {
                font-size: 1rem;
            }

            .new-url a {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo-container">
            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                </svg>
            </div>
        </div>

        <h1>🚀 Site Telah Dipindahkan</h1>

        <p class="message">
            PL Dashboard telah dipindahkan ke domain baru.
            Silakan update bookmark Anda.
        </p>

        <div class="new-url">
            <div class="new-url-label">Alamat Baru</div>
            <a href="https://dashboard.panganlestari.id/" id="newUrl">dashboard.panganlestari.id</a>
        </div>

        <div class="countdown">
            Anda akan dialihkan otomatis dalam <span id="countdown">10</span> detik
        </div>

        <a href="https://dashboard.panganlestari.id/" class="btn">
            Kunjungi Sekarang →
        </a>

        <div class="footer">
            &copy; 2026 PT. Pangan Lestari. All rights reserved.
        </div>
    </div>

    <script>
        // Countdown timer
        let seconds = 10;
        const countdownEl = document.getElementById('countdown');

        const timer = setInterval(() => {
            seconds--;
            countdownEl.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(timer);
                window.location.href = 'https://dashboard.panganlestari.id/';
            }
        }, 1000);
    </script>
</body>

</html>
