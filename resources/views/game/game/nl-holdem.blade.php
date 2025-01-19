<!doctype html>
<html lang="en">

<head>
    <title></title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('static/css/text.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/css/poker.css') }}" type="text/css">
    <!-- <link rel="shortcut icon" href="static/images/chip5.png" /> -->
    <link rel="stylesheet" href="{{ asset('static/css/phone.css') }}" type="text/css" media="only screen and (max-width: 1400px)">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Styles for the container and buttons */
        .container {
            display: flex;
            position: absolute;
            justify-content: flex-end;
            align-items: center;
            height: 100vh;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Style the buttons as needed */
        .button_w {
            color: #fff;
            font-size: x-large;
        }

        .button_ {
            border: none;
            background: none;
            cursor: pointer;
        }

        /* Styles for the emoji popup */
        .emojiPopup {
            position: fixed;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            display: none;
            background: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 10000;
        }

        .emojiSelector {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .emojiPopup,
        .emoji {
            font-size: 5vw;
            cursor: pointer;
        }

        /* Styles for the chat popup */
        .chatPopup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 10000;
        }

        /* Styles for the chat form */
        .chatBody {
            margin-bottom: 10px;
        }

        #chatBodyInput {
            width: 100%;
            height: 100px;
            resize: none;
        }

        .chatActions {
            display: flex;
            justify-content: space-between;
        }
    </style>

    <!-- JS -->
    <script charset="UTF-8" src="{{ asset('static/js/jsholdem/poker.js') }}"></script>
    <script charset="UTF-8" src="{{ asset('static/js/jsholdem/hands.js') }}"></script>
    <script charset="UTF-8" src="{{ asset('static/js/jsholdem/bot.js') }}"></script>
    <script charset="UTF-8" src="{{ asset('static/js/gui_if.js') }}"></script>
</head>

<script>
    var STARTING_BANKROLL = {{ $start_amount }};
    setLocalStorage("playername", '{{ session('name') }}');
</script>

<body onload="parent.init()">

    <audio loop id="bgMusic">
        <source src="{{ asset('static/music/nlholdemBgMusic.mp3') }}" type="audio/mp3">
    </audio>

    <script>
        const audio = document.getElementById('bgMusic');

        function playAudio() {
            audio.play();
        }
        let clicked = false;

        function handleClick() {
            if (!clicked) {
                playAudio();
                clicked = true;
            }
        }

        document.addEventListener('click', handleClick);
        document.addEventListener('touchstart', handleClick);
    </script>


    <form id="form-game-end" action="/game/played" method="post">
        @csrf
        <input type="hidden" name="player" id="player-input">
    </form>
    <form id="form-game-select" action="/game/played-s" method="post">
        @csrf
        <input type="hidden" name="players" id="player-input-s">
    </form>
    @livewireStyles
    @livewire('chat-component')
    @livewireScripts
    <div id="poker_table" class="poker-table" data-uid="">
        <div id="seat0" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="seat1" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="seat2" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="seat3" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="seat4" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="seat5" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="seat6" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="seat7" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="seat8" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="seat9" class="seat">
            <div class="holecards">
                <div class="card holecard1"></div>
                <div class="card holecard2"></div>
            </div>
            <div class="name-chips">
                <div class="player-name"></div>
                <div class="chips"></div>
            </div>
            <div class="bet"></div>
        </div>
        <div id="board">
            <div id="flop1" class="card boardcard"></div>
            <div id="flop2" class="card boardcard"></div>
            <div id="flop3" class="card boardcard"></div>
            <div id="turn" class="card boardcard"></div>
            <div id="river" class="card boardcard"></div>
            <div id="burn1" class="card boardcard"></div>
            <div id="burn2" class="card boardcard"></div>
            <div id="burn3" class="card boardcard"></div>
        </div>
        <div id="pot">
            <div id="current-pot"></div>
            <div id="total-pot"></div>
        </div>
    </div>
    <div id="button" class="seat6-button"></div>
    <div id="history"></div>
    <div id="action-options">
        <div id="fold-button" class="action-button"></div>
        <div id="call-button" class="action-button"></div>
    </div>
    <div id="quick-raises">Quick Raises</div>
    <div id="game-response" class="response-normal">Game response</div>
    <div id="modal-box"></div>
</body>

</html>
