<template>
  
    <section class="product spad">
        <div class="container">
            <div class="trending__product">
                <div class="topdiv" >
                    <div class="title10" >
                        Top 10 Most Viewed
                    </div>
                    <ul class="filtercontrols">
                        <li 
                            :class="{ active: selectedDuration === 'day' }"
                            @click="setDuration('day')">DAY</li>
                        <li 
                            :class="{ active: selectedDuration === 'week' }"
                            @click="setDuration('week')">WEEK</li>
                        <li 
                            :class="{ active: selectedDuration === 'month' }"
                            @click="setDuration('month')">MONTH</li>
                    </ul>
                </div>
                <div class="most-viewed-section">
                    <div class="manga-scroll toplist">
                        <div 
                            v-for="(manga, index) in mangas_10"
                            :key="manga.id"
                            class="manga-item">
                            <a :href="manga.manga ? manga.manga : `manga/${manga.id}`">
                                <div class="product__item">
                                    <div class="ranking-number">{{ index + 1 }}</div>
                                    <div 
                                        class="product__item__pic set-bg" 
                                        :style="{ backgroundImage: `url(${manga.image ? '/storage/' + manga.image : ''})` }">
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                          <li v-show="manga.genre_1 != 'null' ">{{ manga.genre_1 }}</li>
                                          <li v-show="manga.genre_2 != 'null' ">{{ manga.genre_2 }}</li>
                                          <li v-show="manga.genre_3 != 'null' ">{{ manga.genre_3 }}</li>

                                        </ul>
                                        
                                    </div>
                                    <h5 class="name"><a>{{ manga.name }}</a></h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const selectedDuration = ref('day'); // Default to 'day'
const mangas_10 = ref([]);
const error = ref('');

// Function to fetch top 10 mangas based on duration
const fetchTop10 = async (duration) => {
  try {
    const response = await axios.get(`/top10/${duration}`, {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });
    mangas_10.value = response.data.data; // Assign fetched data to mangas_10
  } catch (err) {
    error.value = 'Failed to fetch mangas: ' + (err.response?.data?.message || err.message);
  }
};

// Function to set duration and fetch data
const setDuration = (duration) => {
  selectedDuration.value = duration;
  fetchTop10(duration); // Fetch data based on the selected duration
};

// Fetch mangas on component mount
onMounted(() => {
  fetchTop10(selectedDuration.value);
});
</script>

<style scoped>
.name{
  font-size: large;
  font-family: var(--fontNav);
}
.product__item__text ul{
  display: flex;
  flex-wrap: wrap;
  padding: 3vh 0px 0px;
  height:10vh;
  
}
.product__item__text ul li{
  background-color: var(--genre);
  height: fit-content;
  color: white;
  list-style-type: none;
  padding: 4px 7px;
  border-radius: 30%;
  font-size: x-small;
  margin: 2px;
  font-family: var(--fontNav);
}
.filtercontrols{
  width: 50%;
  display: flex;
  flex-direction: row;
  justify-content: start;
  

}
.filtercontrols li{
  margin-left:17px ;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 10vh;
  background-color:var(--red);
  padding: 3px;
  font-weight: 560;
  border-radius:3px;
  font-family: "Oswald", sans-serif;
  font-size: large;
  color: beige;
  cursor: pointer;
  list-style-type: none;

}
.filtercontrols li.active{
    color: black;
}
.topdiv{
  display: flex;
  align-items: center;
  
}
.title10 {
  width: 50%;
  
  padding-left: 20px;
  font-size: x-large;
  color: var(--white);
  font-family: var(--fontTitle);
  
}
@media only screen and (max-width: 600px) {

  .filtercontrols li{
    width: 20vw;
    font-size: small;
  }
  .filtercontrols li.active{
    font-size: smaller;
  }
  .filtercontrols{
    justify-content: space-between;
    padding-left: 0px;
    padding-right: 10px;
    width: 50%;
  }
  .title10 {
    padding-left: 20px;
    font-size: larger;
  }
}





  .most-viewed-section {
      padding: 20px;
      background-color: #1c1c2b00; /* Dark background for the whole section */
  }

  .manga-scroll {
      display: flex;
      overflow-x: auto; /* Allows horizontal scrolling */
      padding: 20px 0;
  }

  .manga-item {
      position: relative;
      margin-right: 20px;
      text-align: center;
      width: 150px; /* Adjust width based on your image sizes */
      flex-shrink: 0; /* Prevents the items from shrinking when the screen is small */
  }

  .manga-item img, .product__item__pic {
      position: static;
      width: 150px;
      height: 220px;
      object-fit: cover;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
      background-size: 100% auto; 
      background-repeat: no-repeat;
      background-position: center;
  }

  .manga-item h5 {
      color: #fff;
      margin-top: 10px;
  }

  .ranking-number {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: #000;
      color: #fff;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      line-height: 30px;
      text-align: center;
      font-size: 16px;
      font-weight: bold;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  }
  .most-viewed-section{
    width: 98vw;
  }
  /* Optional: Customize scrollbar */
  .manga-scroll::-webkit-scrollbar {
      height: 8px;
  }

  .manga-scroll::-webkit-scrollbar-thumb {
      background-color: #555;
      border-radius: 10px;
  }

</style>
