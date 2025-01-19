<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Collection</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #2b2a2a;
        }

        .space1 {
            margin: 1vh;
        }

        .game {
            background-color: rgb(44, 40, 40);
            background-size: cover;
            background-repeat: no-repeat;
        }

        .title {
            display: flex;
            justify-content: space-between;
            margin: 10px 50px;
            color: white;
        }

        .middle-menu {
            display: flex;
            justify-content: space-between;
            background-color: rgb(46, 46, 44);
            color: #bebaba;
        }

        .micon-btn {
            padding: 10px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            border: 1px solid rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
        }

        .grid-item {
            padding: 20px;
        }

        .grid-item img {
            width: 100%;
            height: auto;
        }

        .grid-item h4 {
            margin: 0;
            text-align: center;
            font-size: 18px;
            color: white;
        }
        
        .grid-item p,
        .grid-item a {
            text-align: center;
            color: white;
            margin: 0;
            display: block;
        }
        .grid-item a {
            background: linear-gradient(to bottom, #0e324c, #001a2d);

            padding: 5px 10px;
            border: 2px solid #0000009a;
            text-decoration: none;
            border-radius: 10px;
            margin: 5px;
        }
    </style>
</head>

<body>
    <div class="game">
        <div class="title">
            <a href="\profile" style="color: white;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div style="display: flex; justify-content: center; align-items:center;">
                My Collection
            </div>
            <div>
                <i class="fas fa-question-circle"></i>
            </div>
        </div>
        <p style="text-align: center;color: white;border-bottom: 2px solid white;"></p>

        <div class="middle-menu">
            <div class="micon-btn">
                Nameplates
            </div>
            <div class="micon-btn">
                Deck
            </div>
            <div class="micon-btn">
                Chip-Con
            </div>
            <div class="micon-btn">
                Toolkit
            </div>
        </div>

        <div class="space1"></div>
        <div class="space1"></div>

        <div class="grid">
            <div class="grid-item">
                <img src="{{ asset('images/game-bg.jpg') }}" alt="Classic">
                <h4>Classic</h4>
                <p>Equipped</p>
            </div>
            <div class="grid-item">
                <img src="{{ asset('images/game-bg.jpg') }}" alt="Classic">
                <h4>Classic</h4>
                <a href="">💰 80</a>
            </div>
            <div class="grid-item">
                <img src="{{ asset('images/game-bg.jpg') }}" alt="Classic">
                <h4>Classic</h4>
                <a href="">💰 80</a>
            </div>
            <div class="grid-item">
                <img src="{{ asset('images/game-bg.jpg') }}" alt="Classic">
                <h4>Classic</h4>
                <a href="">💰 9,000</a>
            </div>
            <div class="grid-item">
                <img src="{{ asset('images/game-bg.jpg') }}" alt="Classic">
                <h4>Classic</h4>
                <a href="">💰 8,000</a>
            </div>
        </div>

    </div>
</body>

</html>
