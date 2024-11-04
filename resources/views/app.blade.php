<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Website')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">



    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">


    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('template/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/css/plyr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}" type="text/css">
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    

<style>
    .fr{
        display: flex;
        justify-content: center
    }
    .log{
        margin-top: 5px;
        padding:10px 20px 10px;
        border-radius: 5px;
        font-weight: 500;

    }
    .signupm{
        background-color: #e83e8c;

    }
    .loginm{
        border-style: solid;
        border-width: 2px;
        border-color: rgb(255, 255, 255);
    }

</style>    
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                    <div class="header__logo">
                        <a >
                            <img src="template/img/logo.png"  alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class=""><a href="{{route('links.index')}}">Homepage</a></li>
                                <li><a href="{{route('links.index')}}">Genres <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">

                                        <li><a href="{{ route('category', 'Action') }}">Action</a></li>
                                        <li><a href="{{ route('category', 'Adventure') }}">Adventure</a></li>
                                        <li><a href="{{ route('category', 'Fantasy') }}">Fantasy</a></li>
                                        <li><a href="{{ route('category', 'Comedy') }}">Comedy</a></li>
                                        <li><a href="{{ route('category', 'Drama') }}">Drama</a></li>
                                        <li><a href="{{ route('category', 'Isekai') }}">Isekai</a></li>
                                        <li><a href="{{ route('category', 'Thriller') }}">Thriller</a></li>
                                        <li><a href="{{ route('category', 'Sports') }}">Sports</a></li>
                                        <li><a href="{{ route('category', 'Mystery') }}">Mystery</a></li>
                                        <li><a href="{{ route('category', 'Martial Arts') }}">Martial Arts</a></li>
                                        <li><a href="{{ route('category', 'Magic') }}">Magic</a></li>
                                        <li><a href="{{ route('category', 'Horror') }}">Horror</a></li>
                                        <li><a href="{{ route('category', 'Sci-Fi') }}">Sci-Fi</a></li>
                                        <li><a href="{{ route('category', 'Supernatural') }}">Supernatural</a></li>
                                        <li><a href="{{ route('category', 'Romance') }}">Romance</a></li>

                                    </ul>
                                </li>
                                <li><a href="{{route('newestchapters')}}"> New Chapters</a></li>
                                <li><a href="{{route('newestmangas')}}"> New Stories</a></li>
                                @auth
                                <li><a href="{{route('Dashboard')}}"> Dashboard</a></li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="">
                    <div class="header__right">
                        @auth
                        <a  class="log"  href="{{route('login.logout')}}">Deconnexion <span class="icon_profile"></span></a>
                        
                        @endauth
                        @guest
                        <a class="loginm log" href="{{route('login')}}">Log In</a>
                        <a class="signupm log" href="{{route('signup')}}">Sign Up</a>


                        @endguest
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    
    <main>
        @yield('content')
    </main>


    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('template/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/js/player.js') }}"></script>
    <script src="{{ asset('template/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('template/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/js/main.js') }}"></script>
    <script src="https://e940-105-235-132-176.ngrok-free.app/resources/js/app.js"></script>



</body>


<footer class="footer">
    <div class="page-up">
        <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
    </div>
    <div class="container fr">
        <div class="col-lg-3">
            <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                linkportalx &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved.
                <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://web.facebook.com/yacinebenbouzid15" target="_blank">Yacine Benbouzid</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>
    </div>
    
    <!-- Social Media Icons Section -->
    <div class="social-icons">
        <a href="https://facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
        <a href="https://instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
        <a href="https://linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
        <a href="https://youtube.com" target="_blank"><i class="fa fa-youtube-play"></i></a>
        <!-- Add more social icons here as needed -->
    </div>
</footer>

</html>
