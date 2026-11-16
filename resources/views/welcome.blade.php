
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subnest - All your subscriptions in one place</title>

    <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: Arial, sans-serif;
                background: #11111b;
                color: #f4f0ff;
                line-height: 1.6;
            }

            nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 22px 8%;
                background: #191925;
                border-bottom: 1px solid #29283a;
            }

            .logo {
                font-size: 25px;
                font-weight: bold;
                color: #a78bfa;
            }

            nav a {
                text-decoration: none;
                color: #d0cadd;
                margin-left: 20px;
            }

            nav a:hover {
                color: #a78bfa;
            }

            .hero {
                text-align: center;
                padding: 100px 20px 85px;
            }

            .hero h1 {
                font-size: 48px;
                line-height: 1.2;
                max-width: 750px;
                margin: 0 auto 20px;
            }

            .hero p {
                color: #aaa5bb;
                max-width: 570px;
                margin: 0 auto 30px;
            }

            .button {
                display: inline-block;
                background: #8b6be8;
                color: white;
                padding: 13px 25px;
                border-radius: 8px;
                text-decoration: none;
                margin: 5px;
                transition: background 0.2s;
            }

            .button:hover {
                background: #7453d1;
            }

            .button.secondary {
                background: transparent;
                color: #b49cff;
                border: 1px solid #8b6be8;
            }

            .button.secondary:hover {
                background: #28213e;
            }

            .features {
                background: #191925;
                padding: 65px 8%;
                text-align: center;
            }

            .features h2 {
                font-size: 30px;
                margin-bottom: 35px;
            }

            .feature-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 25px;
            }

            .feature {
                background: #242333;
                border: 1px solid #343047;
                padding: 30px 20px;
                border-radius: 12px;
                transition: transform 0.2s;
            }

            .feature:hover {
                transform: translateY(-5px);
            }

            .feature h3 {
                margin-bottom: 10px;
                color: #b49cff;
            }

            .feature p {
                color: #aaa5bb;
            }

            footer {
                text-align: center;
                padding: 25px;
                color: #817b91;
                background: #11111b;
            }

            @media (max-width: 700px) {
                .hero h1 {
                    font-size: 34px;
                }

                .feature-grid {
                    grid-template-columns: 1fr;
                }

                nav {
                    padding: 18px 5%;
                }
            }

    </style>
</head>

<body>

    <nav>
        <div class="logo">Subnest.</div>

        <div>
            <a href="#features">Features</a>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <section class="hero">
        <h1>All your subscriptions, under one roof.</h1>

        <p>
            Take control of your recurring expenses.
            Track subscriptions, monitor upcoming payments,
            and understand where your money goes.
        </p>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="button">
                Get started
            </a>
        @endif

        @if (Route::has('login'))
            <a href="{{ route('login') }}" class="button secondary">
                Log in
            </a>
        @endif
    </section>

    <section class="features" id="features">
        <h2>Everything in one place</h2>

        <div class="feature-grid">

            <div class="feature">
                <h3>Manage subscriptions</h3>
                <p>
                    Keep all your recurring subscriptions
                    organized in one place.
                </p>
            </div>

            <div class="feature">
                <h3>Track payments</h3>
                <p>
                    Record payments and keep track
                    of your subscription history.
                </p>
            </div>

            <div class="feature">
                <h3>Never miss a renewal</h3>
                <p>
                    Keep track of upcoming renewal dates
                    with personalized reminders.
                </p>
            </div>

        </div>
    </section>

    <footer>
        © {{ date('Y') }} Subnest. All rights reserved.
    </footer>

</body>
</html>
