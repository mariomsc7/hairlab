<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HairLab</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Styles -->
        <style>
            html, body {
                background-image: linear-gradient(to bottom right, rgb(41, 39, 39), white);
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            h1 {
                color: black;
            }

            .title {
                font-size: 84px;
                font-family: 'Satisfy', cursive;
                text-shadow:5px 5px 10px black;
                color: black;
            }

            .title > div > i {
                font-size: 60px;
            }

            .links > a {
                color: #fff;
                padding: 15px;
                font-size: 20px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                border: 1px solid transparent;
                background-color: #000;
                border-radius: 10px;
                transition: all 0.3s;
            }

            .links > a:hover {
                background-color: #fff;
                border: 1px solid #dde2e6;
                color: #636b6f;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            /* CUSTOM BUTTON */
  
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <img src="{{ asset('images/stile-barber-shop_logo_black.png') }}" alt="">
                <h1 class="text-center">Admin Panel</h1>
                <div class="title m-b-md">
                    Stile Hair Lab
                    <div><i class="far fa-gem"></i></div> 
                </div>
                <div>
                    @if (Route::has('login'))
                    <div class="links">
                        @auth
                            <a class="bn632-hover bn25" href="{{ route('admin.home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                </div>
            </div>
        </div>
    </body>
</html>
