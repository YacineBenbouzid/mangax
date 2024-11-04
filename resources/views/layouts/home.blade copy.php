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
        <div class="slide"><img src="https://imgg-h.mangaina.com/a685e6837eeb3922cb24105503f6526e.jpg/h?ht=1&tw=255" alt="Image 6"></div>
        
        <!-- Original image -->
        <div class="slide"><img src="http://imgg.mangaina.com/bd346fbb196ab62675d01d5daa65237d.jpg" alt="Image 1"></div>
        <div class="slide"><img src="http://imgg.mangaina.com/5937142bdd2afd469713ee8fdade1ffb.jpg" alt="Image 2"></div>
        <div class="slide"><img src="https://imgg-h.mangaina.com/128c3a1fdc9a31efeaabc008e3781002.jpg/h?ht=1&tw=255" alt="Image 3"></div>
        <div class="slide"><img src="https://imgg-h.mangaina.com/a685e6837eeb3922cb24105503f6526e.jpg/h?ht=1&tw=255" alt="Image 4"></div>
        <div class="slide"><img src="https://imgg-h.mangaina.com/8c8a656ee54788c0620b7782fbdae9ce.jpg/h?ht=1&tw=255" alt="Image 5"></div>
        <div class="slide"><img src="https://imgg-h.mangaina.com/a685e6837eeb3922cb24105503f6526e.jpg/h?ht=1&tw=255" alt="Image 6"></div>
        
        <!-- Clone of the frst image1.webpng -->
        <div class="slide"><img src="http://imgg.mangaina.com/bd346fbb196ab62675d01d5daa65237d.jpg" alt="Image 1"></div>
        <div class="slide"><img src="http://imgg.mangaina.com/5937142bdd2afd469713ee8fdade1ffb.jpg" alt="Image 2"></div>

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
        background-image: url('1.webp'); /* Background image */
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
<div class="slider-container">
    <div class="fade left"></div>
    <div class="fade right"></div>
    <div class="slider" id="slider">
        <!-- Slides will be dynamically added here -->
    </div>
</div>

<script>
  // Fetch slider data from the server
  async function fetchSliderData() {
    try {
      const response = await fetch('/slider', {
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${localStorage.getItem('token')}` // Replace with your actual token if needed
        }
      });
      if (!response.ok) {
        throw new Error('Failed to fetch slider data');
      }

      const data = await response.json();
      return data.data; // Assuming the slider images are in data.data
    } catch (error) {
      console.error('Error fetching slider data:', error);
      return [];
    }
  }

  // Render slider images
  function renderSlider(images) {
    const sliderContainer = document.getElementById('slider');
    
    // Add clone of the last slide for looping
    if (images.length > 0) {
      const lastClone = createSlide(images[images.length - 1].image, images[images.length - 1].manga_id);
      sliderContainer.appendChild(lastClone);
    }

    // Add all original slides
    images.forEach((image) => {
      const slide = createSlide(image.image, image.manga_id);
      sliderContainer.appendChild(slide);
    });

    // Add clone of the first slide for looping
    if (images.length > 0) {
      const firstClone = createSlide(images[0].image, images[0].manga_id);
      sliderContainer.appendChild(firstClone);
    }
  }

  // Helper function to create a slide element
  function createSlide(imageUrl, altText) {
    const slideDiv = document.createElement('div');
    slideDiv.classList.add('slide');

    const img = document.createElement('img');
    img.src = `/storage/${imageUrl}`; // Adjust path as needed
    img.alt = altText;
    slideDiv.appendChild(img);

    return slideDiv;
  }

  // Fetch and render the slider on page load
  document.addEventListener('DOMContentLoaded', async () => {
    const images = await fetchSliderData();
    renderSlider(images);
  });
</script>

<script>
    let currentSlide = 1; // Start from the first real image (not the clone)
    const totalSlides = 6;
    const slider = document.getElementById('slider');
    const slide = document.getElementById('slide');


    const slideWidth = 60; // Each slide width in vw

    const slides = slider.children;
    slides[0].style.opacity = '0.5'; // Change opacity of the second child to 0.5
    slides[2].style.opacity = '0.5';

    function moveSlider() {
        currentSlide++;
        slider.style.transform = `translateX(-${(currentSlide * slideWidth) - 20}vw)`;
        const slides = slider.children; // Get all children of the slider
        if (slides.length > 1) { // Check if there are at least 2 children
            slides[currentSlide-1].style.opacity = '0.5'; // Change opacity of the second child to 0.5
            slides[currentSlide+1].style.opacity = '0.5'; // Change opacity of the second child to 0.5
            slides[currentSlide].style.opacity = '1'; // Change opacity of the second child to 0.5
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
<div id="slid"></div>
@endsection
