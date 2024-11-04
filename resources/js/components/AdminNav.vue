<template>
    <div class="container mt-5">
      <h2 class="text-center mb-4">Upload Images with IDs</h2>
      <form @submit.prevent="handleSubmit">
        <div class="row">
          <div class="col-md-6 mb-3" v-for="(image, index) in images" :key="index">
            <label :for="'image' + (index + 1)" class="form-label">Image {{ index + 1 }}</label>
            <input type="file" class="form-control" :id="'image' + (index + 1)" accept="image/*" @change="onImageSelected($event, index)" />
            <input type="text" class="form-control mt-2" v-model="image.id" :placeholder="'Enter ID for Image ' + (index + 1)" />
            <img v-if="image.preview" :src="image.preview" class="img-thumbnail mt-2" />
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100">Submit</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const images = ref(Array.from({ length: 6 }, () => ({ preview: null, id: '' })));
  
  function onImageSelected(event, index) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        images.value[index].preview = e.target.result; // Set the image preview
      };
      reader.readAsDataURL(file);
    }
  }
  
  function handleSubmit() {
    const formData = new FormData();
    images.value.forEach((image, index) => {
      formData.append(`image${index + 1}`, image.preview); // Add image previews to FormData
      formData.append(`id${index + 1}`, image.id); // Add IDs to FormData
    });
  
    // Submit the form data to your API endpoint here
    console.log('Form Data Submitted:', formData);
  }
  </script>
  
  <style scoped>
  .container {
    max-width: 800px;
    margin: auto;
    background: #f9f9f9;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }
  
  .btn {
    transition: background-color 0.3s;
  }
  
  .btn:hover {
    background-color: #0056b3;
  }
  
  .img-thumbnail {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
  }
  </style>
  