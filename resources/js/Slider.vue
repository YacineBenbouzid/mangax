<template>
  <div class="slider-container">
    <div class="fade left"></div>
    <div class="fade right"></div>
    <div class="slider" :style="{ transform: `translateX(-${(currentSlide * slideWidth) - 20}vw)` }" ref="slider">
      <!-- Clone of the last image for looping -->
      <div v-if="sliders.length" class="slide">
        <img :src="`/storage/${sliders[sliders.length - 1].image}`" :alt="sliders[sliders.length - 1].manga_id">
      </div>

      <!-- Original images -->
      <div v-for="(slider, index) in sliders" :key="slider.id" class="slide" :style="{ opacity: index === currentSlide ? '1' : '0.5' }">
        <img :src="`/storage/${slider.image}`" :alt="slider.manga_id">
      </div>

      <!-- Clone of the first image for looping -->
      <div v-if="sliders.length" class="slide">
        <img :src="`/storage/${sliders[0].image}`" :alt="sliders[0].manga_id">
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const sliders = ref([]);
const currentSlide = ref(1);
const totalSlides = ref(0);
const slideWidth = 60; // Slide width in vw

const fetchSlider = async () => {
  try {
    const response = await axios.get('/slider', {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });
    sliders.value = response.data.data;
    totalSlides.value = sliders.value.length;
  } catch (error) {
    console.error('Error fetching sliders:', error);
  }
};

// Exact moveSlider function
const moveSlider = () => {
  const slider = document.getElementById('slider');
  currentSlide.value++;
  slider.style.transform = `translateX(-${(currentSlide.value * slideWidth) - 20}vw)`;

  if (sliders.value.length > 1) {
    sliders.value.forEach((_, index) => {
      const slide = slider.children[index + 1];
      slide.style.opacity = index === currentSlide.value - 1 ? '1' : '0.5';
    });
  }

  if (currentSlide.value === totalSlides.value + 1) {
    setTimeout(() => {
      slider.style.transition = 'none';
      currentSlide.value = 1;
      slider.style.transform = `translateX(-${(currentSlide.value * slideWidth) - 20}vw)`;
      setTimeout(() => {
        slider.style.transition = 'transform 500ms ease';
      }, 50);
    }, 2000);
  }

  if (currentSlide.value === 0) {
    setTimeout(() => {
      slider.style.transition = 'none';
      currentSlide.value = totalSlides.value;
      slider.style.transform = `translateX(-${currentSlide.value * slideWidth}vw)`;
      setTimeout(() => {
        slider.style.transition = 'transform 500ms ease';
      }, 50);
    }, 0);
  }
};

// Auto-transition every 4 seconds
onMounted(() => {
  fetchSlider();
  setInterval(moveSlider, 4000);
});
</script>

<style scoped>
/* Include your existing CSS here */
</style>
