<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat - {{ config('webdet.website_name') }}</title>

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

        .table {
            margin: 20px;
            max-height: 75vh;
            overflow-y: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            color: white;
        }

        th.left,
        td.left {
            padding: 8px;
            text-align: left;
            color: greenyellow;
        }

        th.right,
        td.right {
            width: 50%;
            padding: 8px;
            text-align: right;
            color: royalblue;
        }

        th {
            background-color: #2b2a2a;
            border-bottom: 2px solid rgb(255, 255, 255);
        }

        tr:hover {
            background-color: #3a3636;
        }

        input {
            width: 89%;
        }

        button {
            width: 10%;
            cursor: pointer;
        }

        input,
        button {
            padding: 10px;
        }

        form {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    @php
        if ((int) $id_r == (int) $chats->user1) {
            $sender = 2;
        } elseif ((int) session('id') == (int) $chats->user1) {
            $sender = 1;
        }
    @endphp
    <div class="game">
        <div class="title">
            <a href="/game/friends" style="color: white;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h3>Chat</h3>
            <div>
                <i class="fas fa-question-circle"></i>
            </div>
        </div>

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

        <div class="space1"></div>
        <div style="margin: 20px;">
            <form action="/game/chat/{{ $id_r }}" method="post">
                @csrf
                <input type="text" name="msg" placeholder="Send Message">
                <button type="submit">Send</button>
            </form>
        </div>
        <div class="space1"></div>

        <div class="table">
            @livewireStyles
            @livewire('Chats', ['id_r'=>$id_r,'sender' => $sender])
            @livewireScripts
        </div>
    </div>
</body>

</html>
