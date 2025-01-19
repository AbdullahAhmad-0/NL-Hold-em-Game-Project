<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game History</title>

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

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            column-gap: 20px;
            margin: 20px;
        }

        .card {
            background-image: url("{{ asset('images/game-bg.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            border: 1px solid white;
            margin: 10px 50px;
            text-shadow: 1px 1px 0px rgb(0, 0, 0);
        }

        .card h4 {
            text-align: left;
            background-color: #0a749a;
            display: inline-block;
            font-style: italic;
            padding: 5px 10px;
            padding-right: 30px;
            border-radius: 0 0 100% 0;
        }

        .card h3 {
            margin-top: 100px;
            margin-left: 20px;
            margin-right: 20px;
            text-align: center;
            border-bottom: 1px solid white;
        }

        .card p {
            text-align: center;
        }
        .msg
        {color: red; text-align: center;}
    </style>
</head>

<body>
    <div class="game">
        <div class="title">
            <a href="\" style="color: white;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h3>NL Holdem</h3>
            <div>
                <i class="fas fa-question-circle"></i>
            </div>
        </div>
        <p style="text-align: center;color: white;border-bottom: 2px solid white;">9 Max Players</p>
        
        <div class="space1"></div>
        @if (session('msg'))
            <h3 class="msg">{{session('msg')}}</h3>
            @endif
        <div class="space1"></div>

        <div class="grid">
            <form action="/game/nl-holdem" method="post" id="f1">
                @csrf
                <input type="hidden" name="amount" value="10">
                <a href="#" id="b1">
                    <div class="card">
                        <h3>BB: 100 / 50</h3>
                        <p>Buy in 10 usdt</p>
                    </div>
                </a>
            </form>
            <form action="/game/nl-holdem" method="post" id="f2">
                @csrf
                <input type="hidden" name="amount" value="100">
                <a href="#" id="b2">
                    <div class="card">
                        <h4>PRR +10%</h4>
                        <h3>BB: 400 / 200</h3>
                        <p>Buy in 100 usdt</p>
                    </div>
                </a>
            </form>
            <form action="/game/nl-holdem" method="post" id="f3">
                @csrf
                <input type="hidden" name="amount" value="500">
                <a href="#" id="b3">
                    <div class="card">
                        <h4>PRR +50%</h4>
                        <h3>BB: 2,000 / 1,000</h3>
                        <p>Buy in 500 usdt</p>
                    </div>
                </a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('b1').addEventListener('click', function(event) {
            event.preventDefault();
            var form = document.getElementById('f1');
            form.submit();
        });
        document.getElementById('b2').addEventListener('click', function(event) {
            event.preventDefault();
            var form = document.getElementById('f2');
            form.submit();
        });
        document.getElementById('b3').addEventListener('click', function(event) {
            event.preventDefault();
            var form = document.getElementById('f3');
            form.submit();
        });
    </script>
</body>

</html>
