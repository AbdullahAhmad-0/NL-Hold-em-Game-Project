<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Game</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body a {
            text-decoration: none;
        }
        
        body a img {
            position: absolute;
            z-index: -10;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            }
        
        body a .content {
            background-color: rgba(0, 0, 255, 0.387);
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        body a .content div {
            border-top: 1px solid white;
            border-bottom: 1px solid white;
            background-color: rgba(0, 0, 0, 0.7);
            color: lightblue;
            padding: 5vh 10vw;
            text-align: center;
            font-size: 3vw;
        }

        body a .content h2 {
            text-align: center;
            padding: 5vh 10vw;
            font-size: 5vw;
        }

        .neon-text {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.9), 0 0 20px rgba(255, 255, 255, 0.9), 0 0 30px rgba(255, 255, 255, 0.9);
        }

        .neon-text-b {
            text-shadow: 0 0 10px rgba(173, 216, 230, 0.9), 0 0 20px rgba(173, 216, 230, 0.9), 0 0 30px rgba(173, 216, 230, 0.9);
        }

        .neon-text-bl {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.9), 0 0 20px rgba(0, 0, 255, 0.9), 0 0 30px rgba(255, 0, 255, 0.9);
        }
    </style>
</head>

<body>
    <a href="\game\main">
        <div class="content">
            <img src="{{ asset('images/game-bg.jpg') }}">
            <h2 class="neon-text-b" style="color: white;">Welcome Agent</h2>
            <h2 class="neon-text-bl" style="color: lightblue;">{{ $name }}</h2>
            <div class="neon-text-b">
                Agent {{ $name }}, will compete with real poker pros worldwide on the table at any time and advance the agent level by your own ability.
                <br><br>
                <p style="color: white">Tap To Continue</p>
            </div>
        </div>
    </a>
</body>

</html>
