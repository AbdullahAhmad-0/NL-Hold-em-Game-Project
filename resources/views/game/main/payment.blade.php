<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Payment - {{ config('webdet.website_name') }}</title>

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
                Add Fund
            </div>
            <div class="info">
                <ul>
                    <li>- Keep your account safe</li>
                    <li>- Play on multiple devices</li>
                </ul>
            </div>

            <div class="buttons">
                <form method="POST" action="/game/payment" id="payment_mform">
                    @csrf
                    <select name="payment_m" id="payment_method">
                        <option>Select Your Payment Method</option>
                        @foreach ($payment_method as $item)
                            <option value="{{ $item['name'] }}" @if (session('payment_m') == $item['name']) selected @endif>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </form>

                <script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                        document.getElementById('payment_method').addEventListener('change', function() {
                            const paymentForm = document.getElementById('payment_mform');
                            if (paymentForm) {
                                console.log('paymentMForm found:', paymentForm);
                                paymentForm.submit();
                            } else {
                                console.log('paymentMForm not found');
                            }
                        });
                    });
                </script>

                @if (null !== session('payment_md'))
                    <div class="info">
                        <ul>
                            <p>{{ session('payment_md') }}</p>
                        </ul>
                    </div>
                @endif

                <form action="/game/pay" method="post">
                    @csrf
                    <input type="hidden" name="payment" value="{{ session('payment_m') }}">
                    <input type="number" name="amount" placeholder="Enter Amount">
                    <input type="text" name="trid" placeholder="Enter Transection ID">
                    <button class="submit-button" type="submit">Add Fund</button>
                    @if (session('error'))
                    <br>
                        <p class="error">{{ session('error') }}</p><br>
                    @endif
                    <br><br><a class="submit-button button" href="/game/conversion">Convert USDT To Chips</a>
                    <br><br><a class="guest-button" href="/game/main">Back To Main</a>&nbsp;&nbsp;
                    <a class="guest-button" href="/game/payment-history">Payment History</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
