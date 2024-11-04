<template>

  <div>
    <button @click="AddSerie " class="mtop">Add a New Serie &nbsp &nbsp<i class="fa fa-plus"></i></button>

    <div v-if="isAddChapterVisible" class="newchapter">
      <div class="mmf">
        
            <button class="childd" @click="close" >close    <i class="fa fa-close"></i></button>
          
        <CreateNewChapter :mangaId="id" />
      </div>
    </div>
    <div  v-if="isAddSerieVisible" class="newmanga">
      <div class="mmf">
        
            <button class="childd" @click="close">close    <i class="fa fa-close"></i></button>
          
        <CreateNewSeies :message="id" />
      </div>
    </div>
    <div  v-if="iseditVisible" class="newmanga">
      <div class="mmf">
        
            <button class="childd" @click="edit" >close    <i class="fa fa-close"></i></button>
          
        <CreateNewSeies :message="id"/>
      </div>
    </div>
    <div class="prod">
    <ul v-if="mangas.length">
      <div v-for="manga in mangas" :key="manga.id">
        <div class="myso">
          <div class="mtitle">{{ manga.name }}</div>
          <a :href="`../manga/${manga.id}`" class="divim" ><img :src="`/storage/${manga.image}`" alt="Image" /></a>
          <div class="abn">
            <button @click="AddChapter(manga.id)" class="mbs ">Add Chapter </button>
            <button @click="edit(manga.id)" class="mbs">Edit</button>
            <button @click="deleteManga(manga.id)" class="mbs">Delete</button>
          </div>
        </div>
      </div>
    </ul>

    <p v-else>No mangas found.</p>
    <p v-if="error">{{ error }}</p></div>
  </div>

</template>

<script setup>
import { ref, onMounted } from 'vue'; // Import required functions
import axios from 'axios';
import CreateNewChapter from './components/CreateNewChapter.vue';
import CreateNewSeies from './components/CreateNewSerie.vue';

const mangas = ref([]); // Reactive reference for mangas
const error = ref(null);
const id = ref(0);
const p = ref(2);

const isAddChapterVisible = ref(false);
const isAddSerieVisible = ref(false);
const iseditVisible  = ref(false);

const AddChapter = (idd) => {
  id.value=idd;
  isAddChapterVisible.value = !isAddChapterVisible.value; // Toggle visibility
  

};

const AddSerie = () => {
  id.value=null;
  isAddSerieVisible.value = !isAddSerieVisible.value; // Toggle visibility
  
};
const edit = (idd) => {
  id.value=idd;
  isAddSerieVisible.value = !isAddSerieVisible.value; // Toggle visibility
  
};
const close = () => {
  isAddSerieVisible.value = false; // Toggle visibility

  isAddSerieVisible.value = false; // Toggle visibility
  id.value=null;
  console.log(778);
  fetchMangas();
};
const deleteManga = async (id) => {
  if (confirm("Are you sure you want to delete this manga?")) {
    try {
      const response = await axios.delete(`/Dashboard/Serie/${id}`);
      console.log(response.data.message); // Success message
      mangas.value = mangas.value.filter(manga => manga.id !== id);
      // You can handle redirect or UI changes here
    } catch (error) {
      console.error("Failed to delete manga:", error);
    }
  }
};

const fetchMangas = async () => {
  try {
    const response = await axios.get('/Dashboard/myStories', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
        'Content-Type': 'multipart/form-data', // Required to handle file uploads
      },
    });
    mangas.value = response.data;

    
  } catch (error) {
    error.value = 'Failed to fetch mangas: ' + (error.response?.data?.message || error.message); // Set error message
  }
};

// Fetch mangas on component mount
onMounted(() => {
  fetchMangas();
});
</script>

<style scoped>
body{
  font-family: "Mulish", sans-serif;
}
.mtitle {
  display: flex;
  justify-content: center; 
  color: rgb(255, 255, 255);
  font-weight: 530;
  font-size: larger;
  padding: 15px;
}
.myso {
  width: fit-content;
  height: fit-content;
  margin: 10px;
  
}

@media (min-width: 768px) {
  .myso .divim{
  display: block;
  width: 30vw;
  height: 30vw;
  }
}
@media (max-width: 768px) {
  .prod ul{
    display: flex;
    justify-content: center;
  }
  .myso .divim{
  display: block;
  width: 80vw;
  height:80vw;
}
}
.divim img{
  border-radius: 5px;
  width: 100%;
  height: 100%;
}
.abn {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}
.mbs {
  background-color:transparent;
  color: #e53637;
  font-weight: 550;
  font-size: larger;
  width: auto;
  
}

.yy {
  height: 2000px;
}
.parentt {
  display: flex; /* Enable Flexbox layout */
  justify-content: flex-end; /* Align children to the right */
  align-items: flex-start; /* Align children to the top */
  /* Height of the parent */
}
.childd {
  /* Position the child absolutely */
  top: 0; /* Aligns the top edge of the child to the top of the parent */
  right: 0; /* Aligns the right edge of the child to the right of the parent */
  color: white; /* Text color */
  padding: 10px;
  width: fit-content;
  border-radius: 3px;
}
.mmf{
  display:flex;
  flex-direction:column;
  background-color:white;
  width:fit-content;
}
.prod ul{
    width: fit-content;
    display: flex;
    flex-wrap: wrap ;
  }
body{
  background-color: black;
}
.mtop{
  background-color:transparent;
  color: #e53637;
  font-weight: 550;
  font-size: x-large;
}

</style>
