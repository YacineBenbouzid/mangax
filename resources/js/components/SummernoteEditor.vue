<template>
  <div>
    <div ref="summernote"></div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'; // Import Vue Composition API utilities
import $ from 'jquery';
import 'summernote/dist/summernote-lite.css';
import 'summernote/dist/summernote-lite.js';

// Props
const props = defineProps({
  initialContent: {
    type: String,
    default: ''
  }
});

// Emits
const emit = defineEmits(['update:content']);

// Reference for Summernote element
const summernote = ref(null);

// Sleep function for delays
const sleep = (ms) => {
  return new Promise(resolve => setTimeout(resolve, ms));
};

// Method to inject custom styles
const injectCustomStyles = () => {
  const elements = document.querySelectorAll('.note-btn-group');
  elements.forEach(v => {
    v.style.display = 'flex';
  });
  const elements2 = document.querySelectorAll('.note-toolbar');
  elements2.forEach(v => {
    v.style.display = 'flex';
    v.style.flexWrap='wrap';
  });

};

// Async method to initialize the editor
const initializeEditor = async () => {
  await sleep(0); 
  injectCustomStyles();
};

// onMounted hook to initialize Summernote and set initial content
onMounted(() => {
  console.log(props.initialContent);
  
  $(summernote.value).summernote({
    placeholder: 'Hello stand alone UI',
    tabsize: 2,
    height: 120,
    toolbar: [
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ],
    callbacks: {
      onChange: (contents) => {
        emit('update:content', contents); // Emit the content to the parent
      }
    }
  });

  // Set the initial content in the editor
  $(summernote.value).summernote('code', props.initialContent);

  initializeEditor();
});
</script>

<style scoped>
.note-btn {
  display: flex;
}

</style>
