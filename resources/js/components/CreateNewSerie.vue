<template>
  <div class="frcn">
    <h2>Series Form</h2>

    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <div class="formcontent">
        <div class="frst">
          <!-- Series Title -->
          <label for="seriesTitle">Series Title *</label>
          <input type="text" id="seriesTitle" v-model="form.name" placeholder="Series Title Here" required>

          <!-- Series Type -->
          <label>Series Type *</label>
          <div class="rdgr">
            <input type="radio" id="manga" value="Manga" v-model="form.type">
            <label for="manga">Manga</label>

            <input type="radio" id="webcomic" value="Webcomic" v-model="form.type">
            <label for="webcomic">Webcomic</label>

            <input type="radio" id="novel" value="Novel" v-model="form.type">
            <label for="novel">Novel</label>
          </div>

          <!-- Genre -->
          <div class="genres">
            <div>
              <label for="genre1">Genre 1 *</label>
              <select id="genre1" v-model="form.genre_1" required>
                <option v-for="genre in vgenres" :key="genre" :value="genre">{{ genre }}</option>
              </select>
            </div>
            <div>
              <label for="genre2">Genre 2 (Optional)</label>
              <select id="genre2" v-model="form.genre_2">
                <option v-for="genre in vgenres" :key="genre" :value="genre">{{ genre }}</option>
              </select>
            </div>
            <div>
              <label for="genre3">Genre 3 (Optional)</label>
              <select id="genre3" v-model="form.genre_3">
                <option v-for="genre in vgenres" :key="genre" :value="genre">{{ genre }}</option>
              </select>
            </div>
          </div>
        </div>

        <div class="sec">
          <!-- File Upload -->
          <ImageUpload :width="436" :height="436" :image="form.image" @image-uploaded="handleImageUpload" />

          <!-- Description -->
          <SummernoteEditor class="sum" :initialContent="description" @update:content="updateDescription" aria-required="true"/>
        </div>
      </div>
      
      <!-- Submit Button -->
      <div class="button-container">
        <button type="submit" :disabled="loading">
          <span v-if="loading">Loading...</span>
          <span v-else>Submit</span>
        </button>
      </div>
    </form>

    <!-- Toast Notification -->
    <div v-if="toastMessage" :class="`toast ${toastType}`">{{ toastMessage }}</div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import SummernoteEditor from './SummernoteEditor.vue'; 
import ImageUpload from './ImageUpload.vue'; 
import { genres } from '../genres.js';
import { defineProps } from 'vue';

const props = defineProps({
  message: Number
});

const description = ref(null);
const vgenres = ref(genres);
const loading = ref(false); // New loading state
const toastMessage = ref(""); // Toast message state
const toastType = ref(""); // Toast type state

const form = ref({
  name: '',
  type: '',
  genre_1: '',
  genre_2: '',
  genre_3: '',
  image: '',
});

onMounted(() => {
  GetDataForUpdate();
});

const handleImageUpload = (imageData) => {
  form.value.image = imageData; // Receive the image data from the child component
}

const updateDescription = (content) => {
  description.value = content; // Update the description with emitted content
};

// Function to show a toast message
const showToast = (message, type) => {
  toastMessage.value = message;
  toastType.value = type;
  setTimeout(() => {
    toastMessage.value = ""; // Clear toast after 3 seconds
  }, 3000);
};

const GetDataForUpdate = async () => {
  if (props.message != null) {
    try {
      const response = await axios.get(`/Dashboard/Serie/${props.message}`, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`,
        },
      });
      form.value = response.data.data;
      description.value = response.data.data.description;
    } catch (error) {
      console.error('Form submission error:', error);
      showToast('Error loading form data', 'error');
    }
  }
};

const submitForm = async () => {
  loading.value = true; // Start loading
  const formData = new FormData();
  formData.append('name', form.value.name);
  formData.append('type', form.value.type);
  formData.append('genre_1', form.value.genre_1);
  formData.append('genre_2', form.value.genre_2);
  formData.append('genre_3', form.value.genre_3);
  formData.append('image', form.value.image);
  formData.append('description', description.value);

  try {
    let response;
    if (props.message != null) {
      response = await axios.post(`/Dashboard/Serie/${props.message}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`,
        },
      });
    } else {
      response = await axios.post('/links', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`,
        },
      });
    }
    
    showToast('Form submitted successfully!', 'success');
    form.value = { name: '', type: '', genre_1: '', genre_2: '', genre_3: '', image: '' };
    description.value = '';
  } catch (error) {
    console.error('Form submission error:', error);
    showToast('Form submission failed', 'error');
  } finally {
    loading.value = false; // End loading
  }
};
</script>

<style scoped>
.formcontent {
  display: flex;
}

.frst + .sec {
  margin: 2vw;
}

.genres {
  width: 100%;
}

.sum {
  padding: 20px;
}

@media only screen and (max-width: 600px) {
  .formcontent {
    display: block;
  }
  .frcn {
    width: 100vw;
  }
}

.toast {
  position: fixed;
  bottom: 20px;
  right: 20px;
  padding: 10px;
  color: #fff;
  border-radius: 5px;
  font-size: 14px;
}

.toast.success {
  background-color: #28a745;
}

.toast.error {
  background-color: #dc3545;
}
</style>
