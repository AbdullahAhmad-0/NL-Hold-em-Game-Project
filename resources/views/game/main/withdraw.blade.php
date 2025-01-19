<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Withdraw - {{ config('webdet.website_name') }}</title>

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

        input,
        button,
        select {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button,
        input {
            background: white;
            color: black;
            width: 300px;
            transition: background-color 0.3s, color 0.3s;
        }

        .submit-button:hover {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
        }

        .guest-button {
            color: white;
            background-color: transparent;
            text-decoration: none;
        }

        .guest-button:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <div class="title">
                Payment Withdraw
            </div>
            <div class="info">
                <ul>
                    <li>- Request To Withdraw</li>
                </ul>
            </div>

            <div class="buttons">
                <form action="/game/withdraw" method="post">
                    @csrf
                    <select id="paymentMethod" name="payment_method">
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="crypto_wallet">Crypto Wallet Transfer</option>
                    </select>
                    <br><br>
                    <input type="number" name="amount" placeholder="Enter Amount you want to withdraw">
                    <div id="bankTransferFields">
                        <input type="text" name="bank_name" placeholder="Enter Bank Name">
                        <input type="text" name="card_name" placeholder="Enter Name On Your Card">
                        <input type="text" name="card_no" placeholder="Enter Card Number">
                    </div>
                    <div id="cryptoTransferFields" style="display: none;">
                        <input type="text" name="card_no" placeholder="Enter USDT Wallet Address">
                    </div>
                    <button class="submit-button" type="submit">Withdraw Request</button>
                    @if (session('error'))
                        <br>
                        <p class="error">{{ session('error') }}</p><br>
                    @endif
                    <br><br>
                    <a class="submit-button button" href="/game/payment">Add Fund</a>
                    <br><br>
                    <a class="guest-button" href="/game/main">Back To Main</a>&nbsp;&nbsp;
                    <a class="guest-button" href="/game/withdraw-history">Withdraw History</a>
                </form>
                
                <script>
                    document.getElementById('paymentMethod').addEventListener('change', function() {
                        var bankTransferFields = document.getElementById('bankTransferFields');
                        var cryptoTransferFields = document.getElementById('cryptoTransferFields');
                
                        if (this.value === 'bank_transfer') {
                            bankTransferFields.style.display = 'block';
                            cryptoTransferFields.style.display = 'none';
                        } else if (this.value === 'crypto_wallet') {
                            bankTransferFields.style.display = 'none';
                            cryptoTransferFields.style.display = 'block';
                        }
                    });
                </script>
                
            </div>
        </div>
    </div>
</body>

</html>
