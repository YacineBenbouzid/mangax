<template>
    <div id="app">
      <h2>Upload and Resize Image (W: 436px, H: 436px)</h2>
      <input type="file" @change="onImageSelected" accept="image/*" />
      
      <div v-if="imagePreview" class="image-preview-container">
        <img :src="imagePreview" alt="Image Preview" class="image-preview" />
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        imagePreview: null, // Store the resized image URL
      };
    },
    methods: {
      onImageSelected(event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            const img = new Image();
            img.src = e.target.result;
            
            img.onload = () => {
              // Create a canvas to resize the image
              const canvas = document.createElement("canvas");
              const ctx = canvas.getContext("2d");
  
              // Set canvas dimensions
              canvas.width = 436;
              canvas.height = 436;
  
              // Draw the resized image on the canvas
              ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
  
              // Convert the canvas to a base64 image URL
              this.imagePreview = canvas.toDataURL("image/jpeg");
            };
          }; 
          reader.readAsDataURL(file); // Read the file as a DataURL
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .image-preview-container {
    margin-top: 10px;
    width: 436px;
    height: 436px;
    border: 2px solid #ccc;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .image-preview {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
  }
  </style>
  