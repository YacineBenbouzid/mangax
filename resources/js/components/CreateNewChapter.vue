<template>
  <div class="frcn">
    <div class="close"><button  @click="close">Close</button></div>

    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <h2>Create a New Chapter</h2>
      <ImageUpload :width="436" :height="436" :image="form.image" @image-uploaded="handleFileChange" />

      <label for="link2">Chapter Link:</label>
      <input type="text" v-model="form.link" required />

      <label for="nchapter">Name of the Chapter:</label>
      <input type="text" v-model="form.nchapter" required />

      <label for="date">Date Released of the Chapter:</label>
      <input type="date" v-model="form.date" required />

      <button type="submit">Save</button>
    </form>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import axios from 'axios';
import ImageUpload from './ImageUpload.vue';
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  mangaId: {
    type: Number,
    required: true,
  },
});
const emit = defineEmits();

const form = reactive({
  image: null,
  link: '',
  nchapter: '',
  date: '',
});

const close =()=>{
  emit('updateValue', false);

}
function handleFileChange(image) {
  form.image = image;
}

async function submitForm() {
  const formData = new FormData();
  formData.append('image', form.image);
  formData.append('link', form.link);
  formData.append('nmanga', props.mangaId);
  formData.append('nchapter', form.nchapter);
  formData.append('date', form.date);

  try {
    await axios.post('/Dashboard/chapter', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
    alert('Chapter created successfully!');
  } catch (error) {
    console.error('Failed to create chapter', error);
  }
}
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
input[type="date"],
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

.close {
  opacity: 1;
}
.close button {
  background-color: #EB1616; /* Dark red for close button */
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
