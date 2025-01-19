<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Setting</title>

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

        .s-container {
            margin: 20px;
            color: white;
        }

        .list-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .icon {
            flex: 0 0 auto;
            margin-right: 10px;
        }

        .text {
            flex: 1 1 auto;
        }

        .toggle,
        .more {
            flex: 0 0 auto;
        }

        /* Style for the toggle switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 20px;
            transition: 0.4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            border-radius: 50%;
            transition: 0.4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(20px);
        }
    </style>
</head>

<body>
    <div class="game">
        <div class="title">
            <a href="/game/main" style="color: white;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h3>Settings</h3>
            <div>
            </div>
        </div>

        <div class="space1"></div>

        <p style="margin: 20px;border-bottom: 2px solid white;"></p>

        <div class="s-container">
            {{-- <div class="list-item">
                <div class="icon"><i class="fas fa-star"></i></div>
                <div class="text">Sound</div>
                <div class="toggle">
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>
            </div> --}}

            {{-- <div class="list-item">
                <div class="icon"><i class="fas fa-heart"></i></div>
                <div class="text">Text 2</div>
                <div class="toggle">
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>
            </div> --}}

            {{-- <div class="list-item">
                <div class="icon"><i class="fas fa-arrow-right"></i></div>
                <div class="text">Text 3</div>
                <div class="more"><i class="fas fa-chevron-right"></i></div>
            </div> --}}

            {{-- <div class="list-item">
                <div class="icon"><i class="fas fa-arrow-right"></i></div>
                <div class="text">Text 4</div>
                <div class="more"><i class="fas fa-chevron-right"></i></div>
            </div> --}}
            <div class="list-item">
                <div class="icon"><i class="fas fa-user"></i></div>
                <a href="/game/logout">
                    <div class="text">Logout</div>
                </a>
            </div>

        </div>
    </div>
</body>

</html>
