<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel Login Form</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Login Form Styling */
        #login {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .contact-s {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .grid-item {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .heading-common-s {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .contact-container {
            max-width: 300px;
            margin: 0 auto;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }

        label {
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .submit-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div id="login" class="contact-s cmn-padding">
        <div class="grid-item"></div>
        <div class="grid-item">
            <h2 class="heading-common-s">For Opening Admin Panel Enter Your Credentials.</h2>
            <div class="contact-container">
                <form class="contact-form" method="POST" action="/login_admin">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{session('old_email')}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password">
                    </div>
                    @if (session('error'))
                        <h4>{{ session('error') }}</h4>
                    @endif
                    <button type="submit" class="submit-btn">Login</button>
                </form>
            </div>
        </div>
        <div class="grid-item"></div>
    </div>
</body>

</html>
