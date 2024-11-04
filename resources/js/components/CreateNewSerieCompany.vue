<template>
  <div class="frcn">
    <h2>Series Form</h2>

    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <!-- Series Title -->
      <label for="seriesTitle">Series Title *</label>
      <input type="text" id="seriesTitle" v-model="form.name" placeholder="Series Title Here" required>

      <!-- Series Type -->
      <label>Series Type *</label>
      <div class="rdgr">
        <input type="radio" id="manga" value="Manga" v-model="form.type" >
        <label for="manga">Manga</label>

        <input type="radio" id="webcomic" value="Webcomic" v-model="form.type">
        <label for="webcomic">Webcomic</label>

        <input type="radio" id="novel" value="Novel" v-model="form.type">
        <label for="novel">Novel</label>
      </div>

      <!-- Genre -->
       <div class="genres">
        <div>
          <label for="readingLayouts">Genre 1 *</label>
          <select id="readingLayouts" v-model="form.genre_1" required>
            <option v-for="genre in vgenres" :key="genre" :value="genre">{{ genre }}</option>
          </select>
        </div>
        <div>
          <label for="readingLayouts">Genre 2 (Optional)</label>
          <select id="readingLayouts" v-model="form.genre_2" >
            <option v-for="genre in vgenres" :key="genre" :value="genre">{{ genre }}</option>
          </select>
        </div>
        <div>
          <label for="readingLayouts">Genre 3 (Optional)</label>
          <select id="readingLayouts" v-model="form.genre_3" >
            <option v-for="genre in vgenres" :key="genre" :value="genre">{{ genre }}</option>
          </select>
        </div>
      </div>

      <label for="seriesTitle">Series Link *</label>
      <input type="url" id="seriesTitle" v-model="form.link" placeholder="Series Link Here" required>
      <!-- Default Reading Experience -->


      <!-- File Upload -->
      <ImageUpload @image-uploaded="handleImageUpload" />

      <!-- Submit Button -->
      <div class="button-container">
        <button type="submit">Submit</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { onMounted , ref } from 'vue';
import axios from 'axios';
import { genres } from '../genres.js';
import ImageUpload from './ImageUpload.vue';
import { defineProps } from 'vue';

const props = defineProps({
  message: Number
});
const description= ref(null);
const form = ref({
  name: '',
  type: '',
  genre_1: '',
  genre_2: '',
  genre_3: '',
  image: null,
  link:'',
  
});

onMounted(() => {
  GetDataForUpdate();
});

const handleImageUpload=(imageData) =>{
  form.value.image = imageData; // Receive the image data from the child component
  }
const vgenres=ref(genres);
const updateDescription=(content)=> {
      description.value = content; // Update the description with emitted content
    };
const handleFileChange = (event) => {
  form.value.image = event.target.files[0]; // Capture the selected image file
};

const GetDataForUpdate =  async() => {
if(props.message != null){
  try {
  const response = await axios.get(`/Dashboard/Serie/${props.message}`, {
    headers: {
      'Content-Type': 'multipart/form-data',
      'Authorization': `Bearer ${localStorage.getItem('token')}`, // Assuming you need authentication
    },
  });
  form.value = response.data.data;
  console.log(response.data.data);
  alert('Form submitted successfully!');
} catch (error) {
  console.error('Form submission error:', error);
}
}
};



const submitForm = async () => {
  const formData = new FormData();
  formData.append('name', form.value.name);
  formData.append('type', form.value.type);
  formData.append('genre_1', form.value.genre_1);
  formData.append('genre_2', form.value.genre_2);
  formData.append('genre_3', form.value.genre_3);

  formData.append('link', form.value.link);
  formData.append('image', form.value.image); // Append the image

  try {
    const response = await axios.post('/Dashboard/serie/create', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
        'Authorization': `Bearer ${localStorage.getItem('token')}`, // Assuming you need authentication
      },
    });
    alert('Form submitted successfully!');
  } catch (error) {
    console.error('Form submission error:', error);
  }
};
</script>

<style scoped>
.genres{
  display: flex;
  justify-content: space-between;
}
.frcn{
  width: 50vw;
}

</style>
