@extends('app')

@section('title', 'Home')

@section('content')



<style>
    

    .most-viewed-section {
        padding: 20px;
        background-color: #1c1c2b00; /* Dark background for the whole section */
    }

    .manga-scroll {
        display: flex;
        overflow-x: auto; /* Allows horizontal scrolling */
        padding: 20px 0;
    }

    .manga-item {
        position: relative;
        margin-right: 20px;
        text-align: center;
        width: 150px; /* Adjust width based on your image sizes */
        flex-shrink: 0; /* Prevents the items from shrinking when the screen is small */
    }

    .manga-item img, .product__item__pic {
        position: static;
        width: 150px;
        height: 220px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    }

    .manga-item h5 {
        color: #fff;
        margin-top: 10px;
    }

    .ranking-number {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #000;
        color: #fff;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    }

    /* Optional: Customize scrollbar */
    .manga-scroll::-webkit-scrollbar {
        height: 8px;
    }

    .manga-scroll::-webkit-scrollbar-thumb {
        background-color: #555;
        border-radius: 10px;
    }

</style>

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


<div id="top10"></div>





<div class="ad">



    <div class="dt">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="section-title">
                <h4>New & Trending</h4>
            </div>
        </div>
        @if(isset($smanga))
        <div class="">
            <div class="">
                <div class="">
                    <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/' . $smanga->image) }}">
                        
                    </div>
                </div>
                <div class="">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3>{{$smanga->name}}</h3>
                        </div>

                        <p>{!! $smanga->description !!}</p>

                        <div class="anime__details__widget">
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
    <div class="chu manga-scroll">
        <div>
            <div class="chapter">


                <!-- Webcomic Profile Section -->
                
            
                <!-- Chapters Section -->
                <div class="chapters-section">
                    
                    <ul class="chapter-list">
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
    .ad{
        padding: 10vw;
    }
    .dt{
        width: 30vw;
    }
    .chu{
        width: 40vw;
    }
    @media only screen and (max-width: 600px) {
        .dt{
        width: 70vw;
    }
    .chu{
        width: 70vw;
    }
    }
</style>
<style>

    .slider-container {


        width: 90vw;
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
        padding: 2rem;
        width: 60vw;
        height: 300px;
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
    let currentSlide = 1; // Start from the first real image (not the clone)
    const sliderData = @json($slider);


    const totalSlides = sliderData.length;
    const slider = document.getElementById('slider');
    const slide = document.getElementById('slide');
    const sliderElement = document.querySelector('.slider');
    sliderElement.style.width = `calc(60vw *${totalSlides+4}`;


    const slideWidth = 60; 

    const slides = slider.children;
    slides[0].style.opacity = '0.5'; 
    slides[2].style.opacity = '0.5';

    function moveSlider() {
        currentSlide++;
        slider.style.transform = `translateX(-${(currentSlide * slideWidth) - 20}vw)`;
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
                

                slider.style.transform = `translateX(-${(currentSlide * slideWidth) - 20}vw)`;                setTimeout(() => {
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
