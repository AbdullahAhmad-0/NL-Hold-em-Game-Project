<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('webdet.website_name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @php
        $user_level = $profile[0]['prr'];
        $prr_min = $level[0]['prr_min'];
        $prr_max = $level[0]['prr_max'];

        $range = $prr_max - $prr_min;
        $level_difference = $user_level - $prr_min;

        $percentage = ($level_difference / $range) * 100;

        $percentage = max(0, min(100, $percentage));
    @endphp
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: rgb(7, 7, 6);
        }

        .game {
            background-image: url("{{ asset('images/game-bg.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .top {
            display: flex;
            justify-content: space-between;
        }

        .top-box {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 2px solid #0000009a;
            color: white;
            border-radius: 10px;
            width: 33vw;
            margin: 5px;
        }

        .top-box i {
            margin-right: 5px;
            font-size: 20px;
        }

        .profile {
            background: linear-gradient(to bottom, #585656, #000000);
        }

        .bonus {
            background: linear-gradient(to bottom, #6a316b, #270028);
        }

        .coin {
            background: linear-gradient(to bottom, #0e324c, #001a2d);
        }

        .lowermsg {
            position: absolute;
            transform: translatey(150%);
            text-align: center;
            padding: 5px 0;
            font-size: 10px;
            color: white;
            background-color: transparent;
        }

        .space1 {
            margin: 1vh;
        }

        .top-menu {
            display: flex;
            flex-direction: row;
            align-items: center;
            text-align: center;
        }

        .menu-button {
            padding: 13px 15px;
            margin: 10px;
            border: 1px solid white;
            border-radius: 100%;
            background: #007bff;
            color: #fff;
        }

        .setting-button {
            background: #151515;
            color: #fff;
        }

        .gift-button {
            background: #28a745;
        }

        .trophy-button {
            background: #dc3545;
        }

        .level {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .level .prr {
            color: white;
            padding-top: 10px;
        }

        .progress-bar {
            width: 30vh;
            height: 30vh;
            border-radius: 100%;
            background: conic-gradient(#007bff 0% {{ $percentage }}%, transparent {{ $percentage }}% 100%);

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;
        }

        .progress-bar-inner {
            width: 90%;
            height: 90%;
            border-radius: 100%;
            overflow: hidden;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: rgb(23, 22, 24);
            color: white;
        }

        .progress-bar-inner img {
            font-size: 15vh;
        }

        .progress-bar-inner .lvl {
            padding-top: 10px;
        }

        .middle-menu {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .middle-menu-box {
            background-color: rgb(7, 7, 6);
            height: 2vh;
        }

        .micon-btn {
            font-size: 5vh;
            color: rgb(168, 168, 87);
            background-color: rgb(7, 7, 6);
            padding: 10px 5vw;
            border: 1px solid rgb(0, 0, 0);
            overflow: hidden;
            border-radius: 10px 10px 0 0;
        }

        .games {
            background-color: rgb(7, 7, 6);
            padding: 5px;
        }

        .games-container {
            background-color: rgb(7, 7, 6);
            border: 1px dotted black;
            padding: 10px;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        @media screen and (max-width: 767px) {
            .games-container {
                background-color: rgb(7, 7, 6);
                border: 1px dotted rgb(75, 73, 73);
                padding: 10px;
                display: grid;
                grid-template-columns: 1fr;
            }
            .card {
                border: 2px solid rgb(95, 95, 95) !important;
            }
        }

        .card {
            border: 2px solid black;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
            height: 30vh;
        }

        .card .title {
            background: linear-gradient(to right, #FFD700, #FFA500, #FFD700);
            -webkit-background-clip: text;
            color: transparent;
            display: inline-block;
            font-size: 24px;
            text-shadow: 2px 2px 4px #000;
            text-align: center;
        }

        .card .button {
            color: white;
            background: linear-gradient(to bottom, #585656, #000000);
            border: 1px solid black;
            border-radius: 50px;
            padding: 10px 30px;
        }

        .card .select-table {
            color: white;
            background: linear-gradient(to bottom, #366b31, #0f2800);
            border: 1px solid orangered;
            border-radius: 50px;
            padding: 10px 30px;
        }

        .bottom-menu {
            display: flex;
            justify-content: space-between;
            background-color: rgb(46, 46, 44);
            color: #bebaba;
        }

        .bicon-btn {
            padding: 10px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            border: 1px solid rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        .bicon-btn i {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .bicon-btn a {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #bebaba;
        }
    </style>
</head>

<body>
    <div class="game">
        <div class="top">
            <a href="/game/profile" class="top-box profile">
                <i class="fas fa-user"></i>
                {{ session('name') }}
            </a>
            <div class="top-box bonus">
                <i class="fas fa-gift"></i>
                {{ $profile[0]['chips'] }}
                {{-- <div class="lowermsg">
                    Collect Bonus!
                </div> --}}
            </div>
            <a href="/game/payment" class="top-box coin">
                <i class="fas fa-coins"></i>
                {{ $profile[0]['coin'] }}
                {{-- <div class="lowermsg">
                    Collect Bonus!
                </div> --}}
            </a>
        </div>

        <div class="space1"></div>

        <div class="centertop">
            <div class="top-menu">
                <div class="column">
                    <a href="/game/setting"><button class="menu-button setting-button"><i class="fas fa-cog"></i></button></a>
                </div>
                <div class="gifts">
                    <a href=""><button class="menu-button gift-button"><i class="fas fa-gift"></i></button></a>
                </div>
                <div class="column">
                    <a href="player-rank"><button class="menu-button trophy-button"><i class="fas fa-trophy"></i></button></a>
                </div>
            </div>
            <div class="level">
                <div class="progress-bar">
                    <div class="progress-bar-inner">
                        {{-- <i class="fas fa-dove"></i> --}}
                        <img src="{{ asset($level[0]['icon']) }}" alt="Level">
                        <div class="lvl">{{ $level[0]['level'] }}</div>
                    </div>
                </div>
                <div class="prr">
                    PRR {{ $profile[0]['prr'] }}
                </div>
            </div>
        </div>

        <div class="space1"></div>
        <div class="space1"></div>

        <div class="middle-menu">
            <div class="micon-btn">
                <i class="fas fa-star"></i> <!-- Star icon -->
            </div>
            <div class="micon-btn">
                <i class="fas fa-ship"></i> <!-- Ship icon -->
            </div>
            <div class="micon-btn">
                <i class="fas fa-dice"></i> <!-- Poker icon -->
            </div>
            <div class="micon-btn">
                <i class="fas fa-arrow-right"></i> <!-- Right arrow icon -->
            </div>
            <div class="micon-btn">
                <i class="fas fa-dice"></i> <!-- R icon -->
            </div>
        </div>
        <div class="middle-menu-box">
        </div>

        <div class="games">
            <div class="games-container">
                <div class="card card-1">
                    <div class="title">NL Hold`em</div>
                    <div class="button">Join Now!</div>
                    <a href="select-table" class="select-table">Select Table</a>
                </div>
                <div class="card card-2">
                    <div class="title">PLO</div>
                    <div class="button">Comming Soon!</div>
                    {{-- <a href="select-table" class="select-table">Select Table</a> --}}
                </div>
            </div>
        </div>

        <div class="bottom-menu">
            <div class="bicon-btn"><a href="/game/store">
                    <i class="fas fa-store"></i>
                    <div class="bicon-text">Store</div>
                </a>
            </div>
            {{-- <div class="bicon-btn">
                <i class="fas fa-trophy"></i>
                <div class="bicon-text">Tournament</div>
            </div>
            <div class="bicon-btn">
                <i class="fas fa-play-circle"></i>
                <div class="bicon-text">Play Now</div>
            </div>
            <div class="bicon-btn">
                <i class="fas fa-bullseye"></i>
                <div class="bicon-text">Mission</div>
            </div> --}}
            <div class="bicon-btn"><a href="/game/friends">
                    <i class="fas fa-users"></i>
                    <div class="bicon-text">Friends & Club</div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
