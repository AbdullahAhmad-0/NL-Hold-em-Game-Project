<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile - {{ config('webdet.website_name') }}</title>

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
            text-align: left;
        }

        th {
            background-color: #2b2a2a;
            border-bottom: 2px solid rgb(255, 255, 255);
        }

        tr:hover {
            background-color: #3a3636;
        }

        .right-align {
            text-align: right
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
            color: #bebaba;
        }

        .bicon-btn:hover {
            background-color: rgb(20, 20, 20);
            cursor: pointer;
        }

        .bicon-btn i {
            font-size: 24px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    @php
        $user_level = $level[0]['level'];
        $user_prr = $profile[0]['prr'];
    @endphp
    <div class="game">
        <div class="title">
            <a href="/game/main" style="color: white;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div style="display: flex; justify-content: center; align-items:center;">
                <div style="cursor:pointer;padding: 10px; border: 1px solid white;">
                    <i class="fas fa-user"></i>
                </div>
                <h3 style="cursor:pointer;padding: 10px; border: 1px solid white;">{{ session('name') }}</h3>
                <div style="padding: 10px; border: 1px solid white;">
                    <i class="fas fa-medal"></i>
                </div>
            </div>
            <div>
                <i class="fas fa-question-circle"></i>
            </div>
        </div>
        <p style="text-align: center;color: white;border-bottom: 2px solid white;">ID: #{{ session('id') }}</p>

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
        <div class="space1"></div>

        <p style="text-align: center;color: white;border-bottom: 2px solid white;">ℹ&nbsp;&nbsp;&nbsp;&nbsp;Lv. {{ $user_level }}
            &nbsp;&nbsp;&nbsp;&nbsp;PRR&nbsp;&nbsp;&nbsp;&nbsp;{{ $user_prr }}</p>
        <div class="table">
            @php
                $players = $profiles->toArray();
                usort($players, function ($a, $b) {
                    return $b['prr'] - $a['prr'];
                });

                $searchedPlayerId = session('id');

                $rank = null;
                foreach ($players as $index => $player) {
                    if ($player['user_id'] === $searchedPlayerId) {
                        $rank = $index + 1;
                        break;
                    }
                }

                $prr = 0;
                $bet = 0;
                $win = 0;
                $tbet = 0;
                $twin = 0;
                $count = 0;
                try {
                    $items = json_decode($profile[0]['history'], true);
                    foreach ($items as $key => $item) {
                        $count += 1;
                        $prr_ = (int) $item['prr'];
                        if ($prr <= $prr_) {
                            $prr = $prr_;
                        }
                        $winning = explode(' / ', trim($item['win']));
                        [$bet_, $win_] = $winning;
                        $tbet += $bet_;
                        $twin += $win_;

                        if ($bet <= (int) $bet_) {
                            $bet = $bet_;
                        }
                        if ($win <= (int) $win_) {
                            $win = $win_;
                        }
                    }
                } catch (Exception $e) {
                }
            @endphp
            <table>
                <tr>
                    <td>Current Rank</td>
                    <td class="right-align">{{$rank}}</td>
                </tr>
                <tr>
                    <td>Best PRR</td>
                    <td class="right-align">{{ $prr }}</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th style="text-align: center;">NL Holdem</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <td>Total Played</td>
                    <td class="right-align">{{ $count }}</td>
                </tr>
                <tr>
                    <td>Total Bet</td>
                    <td class="right-align">{{ $tbet }}</td>
                </tr>
                <tr>
                    <td>Largest Bet</td>
                    <td class="right-align">{{ $bet }}</td>
                </tr>
                <tr>
                    <td>Total Win</td>
                    <td class="right-align">{{ $twin }}</td>
                </tr>
                <tr>
                    <td>Largest Win</td>
                    <td class="right-align">{{ $win }}</td>
                </tr>
            </table>
        </div>

        <div class="bottom-menu">
            <a href="/game/collection" class="bicon-btn">
                <i class="fas fa-box"></i>
                <div class="bicon-text">My Collection</div>
            </a>
            <a href="/game/game-history" class="bicon-btn">
                <i class="fas fa-history"></i>
                <div class="bicon-text">Game history</div>
            </a>
        </div>
    </div>
</body>

</html>
