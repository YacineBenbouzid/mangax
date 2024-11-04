<template>
    <section class="anime-details spad">
      <div class="container">
        <div class="ad">
          <div class="dt">
            <div class="anime__details__content">
              <div>
                <div class="col-lg-10">
                  <!-- Image and Stats -->
                  <div class="anime__details__pic set-bg" :style="{ backgroundImage: `url('/storage/${manga.image}')` }">
                    <div class="comment">
                      <i class="fa fa-comments"></i> {{ manga.commentsCount }}
                    </div>
                    <div class="view">
                      <i class="fa fa-eye"></i> {{ manga.nviews }}
                    </div>
                  </div>
                </div>
  
                <!-- Manga Details -->
                <div class="col-lg-9">
                  <div class="anime__details__text">
                    <div class="anime__details__title">
                      <h3>{{ manga.name }}</h3>
                    </div>
                    <p v-html="manga.description"></p>
  
                    <div class="anime__details__widget">
                      <div class="row">
                        <div class="col-lg-6 col-md-6">
                          <ul>
                            <li><span>Type:</span> TV Series</li>
                            <li><span>Genre:</span> Action, Adventure, Fantasy, Magic</li>
                          </ul>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <ul>
                            <li><span>Views:</span> {{ manga.nviews }}</li>
                          </ul>
                        </div>
                      </div>
                    </div>
  
                    <!-- Subscribe Button -->
                    <div class="anime__details__btn">
                      <button @click="toggleFollow" class="follow-btn">
                        <i class="fa fa-heart-o"></i> {{ isFollowing ? 'Unfollow' : 'Follow' }}
                      </button>
                      <a href="#" class="watch-btn">
                        <span>Read First Chapter</span> <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Chapter List -->
            <div class="chu">
              <div class="chapter">
                <div class="chapters-section">
                  <ul class="chapter-list">
                    <li v-for="chapter in chapters" :key="chapter.id">
                      <a :href="chapter.link">
                        <img class="chi" :src="`/storage/${chapter.image}`" alt="Chapter Image" />
                        Chapter {{ chapter.n_chapter }} <span>{{ chapter.date }}</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Comments Section -->
          <div class="row">
            <div class="col-lg-8 col-md-8">
              <div class="anime__details__review">
                <div class="section-title">
                  <h5>Comments</h5>
                </div>
  
                <div v-for="comment in comments" :key="comment.id" class="anime__review__item">
                  <div class="anime__review__item__pic">
                    <img src="img/anime/review-6.jpg" alt="User Image" />
                  </div>
                  <div class="anime__review__item__text">
                    <h6>{{ comment.user.name }} - <span>{{ comment.created_at }}</span></h6>
                    <p>{{ comment.body }}</p>
                  </div>
                </div>
              </div>
  
              <!-- Add Comment Form -->
              <div class="anime__details__form">
                <div class="section-title">
                  <h5>Your Comment</h5>
                </div>
                <form @submit.prevent="submitComment">
                  <textarea v-model="newComment" placeholder="Your Comment"></textarea>
                  <button type="submit">
                    <i class="fa fa-location-arrow"></i> Comment
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        manga: {}, // Manga details
        chapters: [], // Chapters list
        comments: [], // Comments list
        newComment: '', // New comment text
        isFollowing: false, // Following status
      };
    },
    mounted() {
      this.fetchMangaDetails();
      this.fetchChapters();
      this.fetchComments();
    },
    methods: {
      // Fetch manga details
      async fetchMangaDetails() {
        const response = await axios.get('/api/manga/1'); // Adjust the endpoint accordingly
        this.manga = response.data;
        this.isFollowing = response.data.isFollowing;
      },
  
      // Fetch chapters list
      async fetchChapters() {
        const response = await axios.get('/api/manga/1/chapters'); // Adjust the endpoint accordingly
        this.chapters = response.data;
      },
  
      // Fetch comments
      async fetchComments() {
        const response = await axios.get('/api/manga/1/comments'); // Adjust the endpoint accordingly
        this.comments = response.data;
      },
  
      // Submit a new comment
      async submitComment() {
        await axios.post('/api/manga/1/comments', {
          body: this.newComment,
        });
        this.newComment = ''; // Clear the input field
        this.fetchComments(); // Refresh the comments list
      },
  
      // Toggle follow/unfollow
      async toggleFollow() {
        await axios.post(`/api/manga/1/${this.isFollowing ? 'unfollow' : 'follow'}`);
        this.isFollowing = !this.isFollowing;
      },
    },
  };
  </script>
  
  <style scoped>
  /* Add your CSS here */
  </style>
  