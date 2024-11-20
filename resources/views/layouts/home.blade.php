@extends('app')

@section('title', 'Home')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/newHotSerie.css') }}">

@endsection
@section('content')




<div class="slider-container">
    <div class="fade left"></div>
    <div class="fade right"></div>
    <div class="slider" id="slider">
        
        <!-- Clone of the last image for looping -->
        @if($slider->isNotEmpty())
        <div class="slide">
            <a href="{{ url('/manga/' . $slider->last()->manga_id) }}">
                <img src="{{ asset('storage/' . $slider->last()->image) }}" alt="Image {{ $slider->last()->id }}">
            </a>
        </div>
        @endif

        <!-- Original images -->
        @foreach($slider as $slide)
        <div class="slide">
            <a href="{{ url('/manga/' . $slide->manga_id) }}">
                <img src="{{ asset('storage/' . $slide->image) }}" alt="Image {{ $slide->id }}">
            </a>
        </div>
        @endforeach

        <!-- Clone of the first image for looping -->
        @if($slider->isNotEmpty())
        <div class="slide">
            <a href="{{ url('/manga/' . $slider->first()->manga_id) }}">
                <img src="{{ asset('storage/' . $slider->first()->image) }}" alt="Image {{ $slider->first()->id }}">
            </a>
        </div>
        @if($slider->count() > 1)
            <div class="slide">
                <a href="{{ url('/manga/' . $slider->get(1)->manga_id) }}">
                    <img src="{{ asset('storage/' . $slider->get(1)->image) }}" alt="Image {{ $slider->get(1)->id }}">
                </a>
            </div>
        @endif
        @endif

    
    </div>
</div>

<div class="vide"></div>
<div id="top10"></div>



<div class="vide"></div>

<div class="hottitle">
    <div>New & Trending</div>
</div>
<div class="hotserie">

    <div class="left">

        @if(isset($smanga))
        <div class="w40 tor">
            <div class="">
                <div class="cover">
                    <img  src="{{ asset('storage/' . $smanga->image) }}"/>
                        
                    
                </div>
                <div class="">
                    <div class="animedetailstext">
                        <div class="animedetailstitle">
                            <h3>{{$smanga->name}}</h3>
                        </div>

                        <p class="descrotion">{!! $smanga->description !!}</p>

                        <div class="animedetailswidget">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul>

                                        
                                    </ul>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
        </div>
        @endif
    </div>
    <div class="right -">
        <div class="w40 tol">
            <div class="chapter">



                <div class="chapterssection">
                    
                    <ul class="chapterlist">
                        @foreach ( $chapters as $chapter )
                            <a href="{{$chapter->link}}"><li><img class="chi" src="{{ asset('storage/' . $chapter->image) }}">Chapter 1:{{$chapter->n_chapter}} <span>{{$chapter->date}}</span></li></a>
                        @endforeach
            
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<style>

    .slider-container {

        margin-top: 10vh;
        width: 100;
        height: 300px;
        overflow: hidden;
        position: relative;
    }
    .slider-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /*background-image: url('1.webp');  Background image */
        background-size: cover; /* Cover the entire container */
        background-position: center; /* Center the image */
        filter: blur(30px); /* Blur effect */
        z-index: 0; /* Behind other content */
    }
    .slider {
        display: flex;
        transition: transform 500ms ease;
        width: calc(60vw * 9 ); /* 6 images + 2 clones (at start and end for looping effect) */
        transform: translateX(-40vw);
    }
    .slide {
        display: flex;
        justify-content: center;
        width: 60vw;
        height: 300px;
    }
    .slide a {
        display: flex;
        justify-content: center;
        width: 95%;
    }
    .slide img {
        border-radius: 5px;

        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .fade {
        position: absolute;
        top: 0;
        width: 20vw; /* The fade width (adjust as necessary) */
        height: 100%;
        z-index: 1;
        pointer-events: none; /* Allows click-through to the slider */
    }
    .fade.left {
        left: 0;
        background: rgba(0, 0, 0, 0);
    }
    .fade.right {
        right: 0;
        background: rgba(0, 0, 0, 0);
    }

</style>

<script>
    let currentSlide = 0; // Start from the first real image (not the clone)
    const sliderData = @json($slider);

    const totalSlides = sliderData.length;
    let slideWidth;
    if(600 < window.innerWidth){
        slideWidth = 60; 
    }else{

        slideWidth = 100; 
    }

    const def = 100-slideWidth;
    const slider = document.getElementById('slider');
    //const slide = document.getElementById('slide');
    const sliderElement = document.querySelector('.slider');
    let ts=totalSlides + 4
    sliderElement.style.width = `calc(${slideWidth * ts}vw)`;
    sliderElement.style.transform= `translateX(${def})`
    const slidest = document.querySelectorAll('.slide');

    slidest.forEach(slide => {
    slide.style.width = `${slideWidth}vw`; // Set the width you want here
    });


    

    const slides = slider.children;
    slides[0].style.opacity = '0.5'; 
    slides[2].style.opacity = '0.5';




    function moveSlider() {
        currentSlide++;
        slider.style.transform = `translateX(-${(currentSlide * slideWidth) - def/2}vw)`;
        const slides = slider.children;
        if (slides.length > 1) { 
            slides[currentSlide-1].style.opacity = '0.5'; 
            slides[currentSlide+1].style.opacity = '0.5'; 
            slides[currentSlide].style.opacity = '1'; 
        }
        

        const sliderContainer = document.getElementById('sliderContainer');
        const backgroundImageUrl = 'image.png';
        // When reaching the clone of the first slide, reset to the real first slide
        if (currentSlide === totalSlides +1) {
            setTimeout(() => {

                slider.style.transition = 'none'; // Disable transition temporarily
                currentSlide = 1; // Jump back to the first real image
                if (slides.length > 1) { // Check if there are at least 2 children
                    slides[currentSlide-1].style.opacity = '0.5'; // Change opacity of the second child to 0.5
                    slides[currentSlide+1].style.opacity = '0.5'; // Change opacity of the second child to 0.5
                    slides[currentSlide].style.opacity = '1'; // Change opacity of the second child to 0.5
                }
                

                slider.style.transform = `translateX(-${(currentSlide * slideWidth) - def/2}vw)`;                setTimeout(() => {
                    slider.style.transition = 'transform 500ms ease'; // Re-enable the transition
                }, 50); // Small delay to allow browser to repaint
            }, 2000); // Wait for the transition to complete before resetting
        }

        // When moving to the clone of the last image, instantly jump to the real last image
        if (currentSlide === 0) {
            setTimeout(() => {
                slider.style.transition = 'none';
                currentSlide = totalSlides; // Jump to the real last slide
                slider.style.transform = `translateX(-${currentSlide * slideWidth}vw)`; // Reset position
                setTimeout(() => {
                    slider.style.transition = 'transform 500ms ease'; // Re-enable the transition
                }, 50);
            }, 0); // Immediate transition reset
        }
    }

    // Automatically move the slider every 4 seconds
    setInterval(moveSlider, 4000); // 4 seconds interval for smooth autoplay
</script>
@endsection
