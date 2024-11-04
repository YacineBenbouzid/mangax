<template>
  <div>
    <h1>User Mangas</h1>
    <div v-if="isEditVisible">
      This element is now visible!
    </div>
    <ul v-if="mangas.length">
      <div v-for="manga in mangas" :key="manga.id">
        <div class="myso">
          <div class="mtitle">{{ manga.name }}</div>
          <img :src="`/storage/${manga.image}`" alt="Image" />
          <div class="abn">
            <button @click="edit" class="mbs">edit</button>
            <button class="mbs">add chapter</button>
            <button class="mbs">delete</button>


          </div>
        </div>

      </div>


    </ul>
 
    <p v-else>No mangas found.</p>
    <p v-if="error">{{ error }}</p>
  </div>

  <div v-if="isEditVisible" class="newchapter">

    <form @submit.prevent="submitForm" class="frcd" enctype="multipart/form-data">
      <div class="parentt">
      <button class="childd" @click="edit" >close    <i class="fa fa-close"></i></button>

    </div>
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

      <label for="nmanga">Name of the Manga:</label>
      <select v-model="form.nmanga" id="type" required>
        <option v-for="manga in mangas" :key="manga.id" :value="manga.id">{{ manga.name }}</option>
      </select>

      <label for="nchapter">Name of the Chapter:</label>
      <input type="text" v-model="form.nchapter" required />

      <label for="date">Date Released of the Chapter:</label>
      <input type="date" v-model="form.date" required />

      <button type="submit">Save</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {

  data() {
    return {
      mangas: [],
      error: null,
      image: null,
      isEditVisible: false,
      bdy:'visible',
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
    this.fetchMangas();
  },
  methods: {
    edit (){
      
      this.isEditVisible = !this.isEditVisible;
      const body = document.body;
            /*if (body.style.overflow === 'hidden') {
                body.style.overflow = ''; // Reset to default
            } else {
                body.style.overflow = 'hidden'; // Set to hidden
            }*/
    },

    async fetchMangas() {
      try {
        const response = await axios.get('/Dashboard/myStories', {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Content-Type': 'multipart/form-data', // Required to handle file uploads
          },
        });
        this.mangas = response.data;
      } catch (error) {
        this.error = 'Failed to fetch mangas: ' + (error.response?.data?.message || error.message);
      }
    },

    handleFileChange(event) {
    this.form.image = event.target.files[0]; // Correctly store the selected file
  },
    async submitForm() {
      const formData = new FormData();
      formData.append('image', this.form.image);
      formData.append('link', this.form.link);
      formData.append('nmanga', this.form.nmanga);
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
.mtitle{

  display: flex;
  justify-content: center;  /* Centers horizontally */
}
.myso{
  width: 40vh;
}
.abn{
  display: flex;
  flex-direction: row;
}
.mbs{
  background-color: rgba(228, 58, 100, 0.767);
}


.yy{
  height: 2000px;
}
.parentt {
    display: flex;          /* Enable Flexbox layout */
    justify-content: flex-end; /* Align children to the right */
    align-items: flex-start;  /* Align children to the top */
         /* Height of the parent */
}
.childd {
 /* Position the child absolutely */
    top: 0;            /* Aligns the top edge of the child to the top of the parent */
    right: 0;          /* Aligns the right edge of the child to the right of the parent */
    color: white;      /* Text color */
    padding: 10px;
    width:fit-content ;
    border-radius: 3px;
}
</style>
