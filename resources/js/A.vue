<template>
  <OnOffSlider @update:featureEnabled="updateFeatureEnabled" />
  
  <section v-if="featureEnabled" class="story-slide">
    <h2>Featured Sliders</h2>
    <div class="slider-container">
      <div 
        class="slide-item" 
        v-for="(slider, index) in sliders" 
        :key="slider.id">
        <img :src="`/storage/${slider.image}`" :alt="slider.manga_id" class="slide-image">
        <h3 class="story-title"></h3>
        <button @click="deleteStory(slider.id)" class="delete-button">Delete</button>
      </div>
    </div>

    <h3>Add a New Story</h3>
    <select v-model="newSlider.manga_id" class="story-select" placeholder="Select Story">
      <option disabled value="">Select Story</option>
      <option v-for="(story, index) in stories" :key="index" :value="story.id">
        {{ story.name }}
      </option>
    </select>

    <div class="imagein">
      <ImageUpload 
        :width="800" 
        :height="300" 
        :image="newSlider.image" 
        @image-uploaded="(file) => handleImageUpload(file)" 
      />
    </div>
    
    <button @click="addStory" class="add-button">Add Story</button>
  </section>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import ImageUpload from './components/ImageUpload.vue';
import axios from 'axios';
import OnOffSlider from './components/OnOffSlider.vue';

const sliders = ref([]); 
const stories = ref([]); 
const newSlider = ref({ manga_id: '', image: '' });
const featureEnabled = ref(false); // Add featureEnabled state

const handleImageUpload = (file) => {
  newSlider.value.image = file;
}

const fetchSlider = async () => {
  try {
    const response = await axios.get('/slider', {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });
    sliders.value = response.data.data;
  } catch (error) {
    console.error('Error fetching sliders:', error);
  }
};

const fetchStories = async () => {
  try {
    const response = await axios.get('/stories', {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });
    stories.value = response.data.data;
  } catch (error) {
    console.error('Error fetching stories:', error);
  }
};

const addStory = async () => {
  if (newSlider.value.manga_id && newSlider.value.image) {
    try {
      const formData = new FormData();
      formData.append('manga_id', newSlider.value.manga_id);
      formData.append('image', newSlider.value.image);

      const response = await axios.post('/slider', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`,
        },
      });

      sliders.value.push({
        id: response.data.story.id,
        manga_id: response.data.story.manga_id,
        image: response.data.story.image,
      });

      newSlider.value.manga_id = '';
      newSlider.value.image = '';
    } catch (error) {
      console.error('Error adding story:', error.response.data);
    }
  } else {
    alert('Please fill in all fields');
  }
};

const deleteStory = async (id) => {
  try {
    await axios.delete(`/slider/${id}`);
    sliders.value = sliders.value.filter(slider => slider.id !== id);
  } catch (error) {
    console.error('Error deleting story:', error);
  }
};

// Function to update featureEnabled based on emitted value
const updateFeatureEnabled = (value) => {
  featureEnabled.value = value; // Update the featureEnabled state
};

onMounted(() => {
  fetchSlider();
  fetchStories();
});
</script>


<style scoped>
.story-slide {
  width: 90%;
  margin: auto;
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.slider-container {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
  gap: 10px;
  padding: 10px;
  margin-top: 20px;
}

.slide-item {
  min-width: 200px;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 10px;
  transition: transform 0.3s ease;
  text-align: center;
}

.slide-item:hover {
  transform: translateY(-5px);
}

.slide-image {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
}

.story-title {
  font-size: 18px;
  margin: 10px 0;
  color: #333;
}

.delete-button, .add-button {
  padding: 8px 16px;
  background-color: #ff5f5f;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.delete-button:hover, .add-button:hover {
  background-color: #ff3b3b;
}

.story-select {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border-radius: 4px;
  border: 1px solid #ddd;
  background-color: #ffffff;
  color: #333;
}
.imagein{
  display: flex;
  justify-content: center;
  width: 100%;
}
</style>
