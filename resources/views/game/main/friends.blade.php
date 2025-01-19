<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Friends - {{ config('webdet.website_name') }}</title>

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
        }

        table {
            border-collapse: collapse;
            width: 100%;
            color: white;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #2b2a2a;
            border-bottom: 2px solid rgb(255, 255, 255);
        }

        tr:nth-child(even) {
            background-color: #0a0909;
        }

        tr:hover {
            background-color: #3a3636;
        }
    </style>
</head>

<body>
    <div class="game">
        <div class="title">
            <a href="/game/main" style="color: white;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h3>Friends</h3>
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
        <div class="middle-menu">
            <div class="micon-btn">
            </div>
            <div class="micon-btn">
                <style>
                    form input,
                    form button {
                        background-color: #2b2a2a;
                        color: #bebaba;
                    }
                </style>
                <form action="/game/friends/" method="post">
                    @csrf
                    <input type="text" placeholder="Search Friend" name="search">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="micon-btn">
                <a href="/game/world">World</a>
            </div>
        </div>

        <div class="space1"></div>
        <div class="space1"></div>

        <div class="table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>PRR</th>
                    <th>&nbsp;</th>
                </tr>
                @php
                    if (isset($items)) {
                        foreach ($items as $key => $item) {
                            echo '<tr>';
                            echo '<td>' . $item['id'] . '</td>';
                            echo '<td>' . $item['name'] . '</td>';
                            echo '<td>' . $item['prr'] . '</td>';
                            echo '<td><a href="/game/chat/' . $item['id'] . '">Message</a>&nbsp;&nbsp;<a href="/game/friends/remove/' . $item['id'] . '">Remove Friend</a></td>';
                            echo '</tr>';
                        }
                    } else {
                        try {
                            $items = json_decode($profile[0]->friends, true);
                            foreach ($items as $key => $item) {
                                echo '<tr>';
                                echo '<td>' . $item['id'] . '</td>';
                                echo '<td>' . $item['name'] . '</td>';
                                echo '<td>' . $item['prr'] . '</td>';
                                echo '<td><a href="/game/chat/' . $item['id'] . '">Message</a>&nbsp;&nbsp;<a href="/game/friends/remove/' . $item['id'] . '">Remove Friend</a></td>';
                                echo '</tr>';
                            }
                        } catch (Exception $e) {
                        }
                    }
                @endphp
            </table>
        </div>
    </div>
</body>

</html>
