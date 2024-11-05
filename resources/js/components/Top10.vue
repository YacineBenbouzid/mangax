<template>
    <section class="product spad">
        <div class="container">
            <div class="trending__product">
                <div class="col-lg-8 col-md-8 col-sm-8 product__sidebar__view">
                    <div class="section-title">
                        <h4>Top 10 Most Viewed</h4>
                    </div>
                    <ul class="filter__controls">
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
                                            <li v-if="manga.genre_1">{{ manga.genre_1 }}</li>
                                            <li v-if="manga.genre_2">{{ manga.genre_2 }}</li>
                                            <li v-if="manga.genre_3">{{ manga.genre_3 }}</li>
                                        </ul>
                                        <h5><a>{{ manga.name }}</a></h5>
                                    </div>
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
.filter__controls li{
     background-color:#e53637;
     padding:6px;
     padding-right:16px;
     padding-left:16px;
     font-weight: 560;
     border-radius:5px;
     font-family: "Oswald", sans-serif;
     font-size: large;
     color: beige;
}
@media only screen and (max-width: 600px) {
  h4{
    font-size: small;
  }
  .filter__controls li{
    font-size: small;
    padding:3px 5px;
  }
  .filter__controls li.active{
    font-size: smaller;
  }
}
</style>
