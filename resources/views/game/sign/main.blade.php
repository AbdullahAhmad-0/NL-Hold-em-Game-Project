<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome - {{config('webdet.website_name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url("{{ asset('images/splash.jpeg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            width: 100vw;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
        }

        .box {
            border: 3px solid transparent;
            border-image: linear-gradient(to right, gold, darkgoldenrod);
            border-image-slice: 1;
            padding: 20px;
            width: 400px;
            background: radial-gradient(circle, rgb(24, 1, 1), rgb(0, 0, 0));
            text-align: center;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: white;
        }

        .info {
            text-align: left;
            margin-bottom: 20px;
            border: 1px solid white;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            color: white;
        }

        ul {
            padding: 0;
            list-style: none;
        }

        li {
            margin: 10px 0;
        }

        .buttons {
            text-align: center;
        }
        
        .submit-button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            
            background: white;
            color: black;
            width: 300px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }
        .submit-button:hover {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <div class="title">
                Welcome to {{config('webdet.game_name') }}
            </div>
            @if (session('id'))
            <div class="buttons">
                <a href="/game/welcome" class="submit-button">Goto Game {{session('name')}}</a>
            </div>
            @endif
            <div class="info">
                <ul>
                    <li>- Get {{config('webdet.on_start_chips')}} Chips!</li>
                    <li>- Keep your cards account safe</li>
                    <li>- Play on multiple devices</li>
                </ul>
            </div>
            <div class="buttons">
                <a href="/game/sign-up" class="submit-button">Create Account</a>
                <a href="/game/sign-in" class="submit-button">Login</a>
            </div>
        </div>
    </div>
</body>

</html>
