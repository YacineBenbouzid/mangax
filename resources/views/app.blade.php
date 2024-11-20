<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'linkportalx')</title>



    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    @yield('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">



    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    

<style>
    .fr{
        display: flex;
        justify-content: center
    }
    
</style>    
</head>
<body>
    <nav class="nav">
        
        <a href="{{route('links.index')}}" class="logo">
            
            <img  src="{{ asset("img/logo.png")}}"  alt="">
            
        </a>
        <div class="navlist">

                <a href="{{route('links.index')}}">Homepage</a>
                <a href="{{route('links.index')}}">Genres <span class="arrow_carrot-down"></span></a>

                
                <a href="{{route('newestchapters')}}"> New Chapters</a>
                <a href="{{route('newestmangas')}}"> New Stories</a>
                @auth
                <a href="{{route('Dashboard')}}"> Dashboard</a>
                @endauth

        </div>
        <div class="navlog">
            <div class="flog">

                @auth
                <a  class="log micon"  href="{{route('login.logout')}}"><i class="fa fa-sign-out" style="font-size:40px"></i></a>
                <a  class="log"  href="{{route('login.logout')}}">Log out &nbsp;&nbsp;<i class="fa fa-sign-out" style="font-size:20px"></i></a>
                
                @endauth
                @guest
                <a class="loginm log" href="{{route('login')}}">Log In</a>
                <a class="micon log" href="{{route('login')}}"><i class="fa fa-user" style="font-size:40px"></i>
                </a>
                <a class="signupm log" href="{{route('signup')}}">Sign Up</a>


                @endguest

            </div>
        </div>

        <div class="navmenu">
            <div class="navcontainer" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
              </div>
        </div>
            
            
    </nav>

    
    <main>
        @yield('content')
    </main>


    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/nav.js') }}"></script>




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
