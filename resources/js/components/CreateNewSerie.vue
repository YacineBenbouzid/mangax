<template>
  <div class="frcn">
    
    
    <div class="close"><button  @click="close">Close</button></div>
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
import { defineProps, defineEmits } from 'vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
  message: Number
});

const description = ref(null);
const vgenres = ref(genres);
const loading = ref(false); // New loading state
const toastMessage = ref(""); // Toast message state
const toastType = ref(""); // Toast type state
const emit = defineEmits();
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
const ggt = () => {
  toast("Wow so easy !", {autoClose: 1000,});
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
const close =()=>{
  emit('updateValue', false);

}
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
      emit('updateValue', false);
      toast.info("Your series has been updated successfully!", {position: toast.POSITION.TOP_RIGHT})
    } else {
      response = await axios.post('/links', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${localStorage.getItem('token')}`,
        },
      });
      emit('updateValue', false);
      toast.success("Your series has been created successfully!", {position: toast.POSITION.TOP_RIGHT})
    }
    

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
.frcn {
    background-color: #2b2b2b; /* Dark background */
    color: white; /* Default text color for the form */
    padding: 20px;
    border-radius: 8px;
}

/* Labels */
label {
    color: #f5f5f5; /* Lighter white for readability */
}

/* Input fields */
input[type="text"],
input[type="radio"] {
    background-color: #333; /* Dark input background */
    color: white;
    border: 1px solid #555; /* Subtle border for input fields */
    padding: 8px;
    border-radius: 4px;
}

/* Dropdown selectors */
select {
    background-color: #333;
    color: white;
    border: 1px solid #555;
    padding: 8px;
    border-radius: 4px;
}

/* Dark mode for buttons */
button {
    background-color: #444; /* Darker button background */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #555; /* Slightly lighter on hover */
}

/* Close button specific styling */
.close button {
    background-color: #d9534f; /* Dark red for close button */
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
}

/* Dark background and white text for .note-editor */
.sum {
    background-color: #333;
    color: white;
    border-radius: 4px;
    padding: 10px;
}

/* Toast Notification */
.toast {
    background-color: #444; /* Dark background for toast */
    color: white;
    padding: 10px;
    border-radius: 4px;
}

/* Genres container */
.genres div {
    margin-bottom: 10px;
}

@media only screen and (max-width: 600px) {
  .formcontent {
    display: block;
  }
  .frcn {
    width: 100vw;
  }
}

</style>
