<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Player Rank</title>

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

        td img {
            width: auto;
            height: 20px;
        }

        th {
            background-color: #3d3838;
            border-bottom: 2px solid rgb(255, 255, 255);
        }

        tr:nth-child(even) {
            background-color: #1a1919;
        }

        tr:hover {
            background-color: #3a3636;
        }

        .prr-summit {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .prr-summit img {
            width: 50vw;
            height: auto;
        }

        .pagination a {
            color: blue;
            transition: color 0.2s cubic-bezier(0, 1.41, 1, -0.58) 0.2s;
        }

        .pagination a:hover {
            text-decoration: underline;
            color: #ac8113;
        }

        .w-5 {
            display: none
        }
    </style>
</head>

<body>
    <div class="game">
        <div class="title">
            <a href="/game/main" style="color: white;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h3>Player Rank</h3>
            <div>
                <i class="fas fa-question-circle"></i>
            </div>
        </div>

        <div class="middle-menu">
            <div class="micon-btn">
                PRR
            </div>
            <div class="micon-btn">
                Daily Battle
            </div>
        </div>

        <div class="space1"></div>
        <div class="space1"></div>

        <div class="prr-summit">
            <img src="{{ asset('images/game-bg.jpg') }}" alt="Classic">
        </div>
        <p style="margin: 20px;font-size:x-large;text-align: center;color: white;border-bottom: 2px solid white;">PRR Summit Top 100</p>

        <div class="table">
            <table>
                <tr>
                    <th>Rank#</th>
                    <th>Player</th>
                    <th>PRR</th>
                    <th>Coin</th>
                    <th>Chips</th>
                </tr>
                @php
                    try {
                        $count = 0;
                        foreach ($profiles as $key => $item) {
                            $count += 1;
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $item->user['name'] . '</td>';
                            echo '<td>' . $item['prr'] . '</td>';
                            echo '<td>' . $item['coin'] . '</td>';
                            echo '<td>' . $item['chips'] . '</td>';
                            echo '</tr>';
                        }
                    } catch (Exception $e) {
                    }
                @endphp
            </table>
        </div>
        <div class="middle-menu">
            <div class="micon-btn">
                <div class="pagination">
                    {{ $profiles->links() }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
