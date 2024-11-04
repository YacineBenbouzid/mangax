<template>
  <div class="im">
    <input type="file" @change="onImageSelected" accept="image/*" /> 
    <div v-if="imagePreview"></div>
    <div class="label" v-else>
      <i class="fas fa-upload"></i>
      <p>Click or Drag to Upload Image</p>
    </div>
    <div v-if="imagePreview" class="image-preview-container" :style="{ width: width + 'px', height: height + 'px' }">
      <img :src="imagePreview" alt="Image Preview" class="image-preview" />
    </div>
  </div>
</template>

<script setup>
import { ref, watch, defineProps, defineEmits } from 'vue';

// Define props using `defineProps`
const props = defineProps({
  width: {
    type: Number,
    default: 436, // Default width
  },
  height: {
    type: Number,
    default: 436, // Default height
  },
  image: {
    type: String,
    default: '', // Default image URL
  },
});

// Define emits for communication with the parent component
const emit = defineEmits(['image-uploaded']);

// Reactive state for the image preview
const imagePreview = ref('');

// Watch for changes in the `image` prop and set the preview
watch(() => props.image, (newValue) => {
  if (newValue && typeof newValue === 'string') {
    imagePreview.value = `/storage/${newValue}`;
    console.log(imagePreview.value)
  }
}, { immediate: true });

// Function to handle file selection and resizing
function onImageSelected(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      const img = new Image();
      img.src = e.target.result;

      img.onload = () => {
        // Create a canvas to resize the image
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Set canvas dimensions based on props
        canvas.width = props.width;
        canvas.height = props.height;

        // Draw the resized image on the canvas
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        // Convert the canvas to a base64 image URL
        imagePreview.value = canvas.toDataURL('image/jpeg');

        // Emit the resized image data to the parent
        emit('image-uploaded', file);
      };
    };
    reader.readAsDataURL(file); // Read the file as a DataURL
  }
}
</script>

<style scoped>
.image-preview-container {
  margin-top: 10px;
  border: 2px solid #ccc;
  display: flex;
  justify-content: center;
  align-items: center;
}
.im {
  display: flex;
  justify-content: center;
}

.image-preview {
  max-width: 100%;
  max-height: 100%;
  object-fit: cover;
}
</style>
