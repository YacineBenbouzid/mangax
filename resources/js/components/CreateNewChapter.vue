<template>



  
      <form @submit.prevent="submitForm" class="frcd" enctype="multipart/form-data">

            
            <h2>Create a New Chapter</h2>
            <div class="im">
            <input type="file" @change="handleFileChange" accept="image/*" />
            <div class="label">
                <i class="fas fa-upload"></i>
                <p>Click or Drag to Upload Image</p>
            </div>
            </div>
    
            <label for="link2">Chapter Link:</label>
            <input type="text" v-model="form.link" required />



    
            <label for="nchapter">Name of the Chapter:</label>
            <input type="text" v-model="form.nchapter" required />
    
            <label for="date">Date Released of the Chapter:</label>
            <input type="date" v-model="form.date" required />
    
            <button type="submit">Save</button>
      </form>

  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'CreateNewChapter',
    props :{
        mangaId: {

        type: Number,
        required: true,
        },
    },

    data() {
      return {
        isOn:false,
        mangas: [],
        error: null,
        image: null,
        form: {
          image: null,
          link: '',
          nmanga: '',
          nchapter: '',
          date: '',
        },
      };
    },
    mounted() {
      
    },
    methods: {

  

  
      handleFileChange(event) {
      this.form.image = event.target.files[0]; // Correctly store the selected file
    },
      async submitForm() {
        const formData = new FormData();
        formData.append('image', this.form.image);
        formData.append('link', this.form.link);
        formData.append('nmanga',this.mangaId);
        formData.append('nchapter', this.form.nchapter);
        formData.append('date', this.form.date);
  
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
      },
    },
  };
  
  </script>
  
  
  
  
  
  
  <style scoped>

  </style>
  