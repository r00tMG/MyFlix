<template>
  <Header/>

    <div class="container w-75 p-5 m-auto">
      <div v-if="film" class="card m-5 text-bg-dark">
        <video :src="film.storage+ '/' + film[0].film" controls></video>
<!--        <img :src="film[0].affiche" class="card-img" alt="...">-->
        <div class="card-img">
          <h5 class="card-title">Titre : {{film[0].titre}}</h5>
          <button class="btn btn-primary" @click="addToFavorites(film[0].id)">Add To Favory</button>
          <p class="card-text">Description : {{film[0].description}}</p>
          <p class="card-text">Date de Sortie : <small>{{film[0].date_de_sortie}}</small></p>
        </div>
        <div class="w-50 m-auto">
          <h3 class="text-center my-5">Commentaires et notes</h3>
          <div v-for="rating in ratings[0]" :key="rating.id">
            <p><strong>{{ rating.user.name }}</strong> ({{ rating.rating }}/5)</p>
            <p>{{ rating.comment }}</p>
          </div>
           <form @submit.prevent="submitRating">
             <div class="form-group mb-2">
                <input v-model="film_id" name="film_id" class="form-control" type="number" hidden required />
             </div>
             <div class="form-group mb-2">
                <input v-model="rating" type="number" name="rating" class="form-control" min="1" max="5" placeholder="Note (1-5)" required />
             </div>
             <div class="form-group mb-2">
                <textarea v-model="comment" name="comment" class="form-control" placeholder="Commentaire"></textarea>
             </div>
             <div class="form-group text-center">
                <button class="btn btn-primary" >Soumettre</button>
             </div>
          </form>
        </div>
      </div>
    </div>

  <Footer/>
</template>

<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import {onMounted, ref} from "vue";
import {useRouter, useRoute} from "vue-router";
import axios from "@/axios.js";
import {addFavorite} from "@/services/favoriteService.js";

export default {
  name: "ShowPage",
  methods: {addFavorite},
  components: {
    Footer,
    Header
  },
  setup(){
    const film = ref()
    const route = useRoute()
    const storage = ref('')
    const ratings = ref([])
    const film_id = ref(route.params.id)
    const rating = ref('')
    const comment = ref('')
    console.log(film_id.value, rating.value, comment.value)
    onMounted(async () => {
      try {
        const token = localStorage.getItem('token')
        const response = await axios.get(`/films/${route.params.id}`,{
          headers:{
            'Content-Type':"application/json",
            'Authorization':`Bearer ${token}`
          }
        });
        film.value = response.data;
        //console.log(film.value.storage)
        const storage = film.value.storage
        //console.log(storage)
      } catch (error) {
        console.error('Failed to fetch film data:', error);
      }

    });
    const fetchRatings = async () => {
      const token = localStorage.getItem('token');
      const r = await axios.get(`http://localhost:8000/api/films/${route.params.id}/ratings`, {
        headers: { 'Authorization': `Bearer ${token}` }
      })
      ratings.value = await r.data
      //console.log(ratings.value[0][0])

    }
    onMounted(async ()=>{
     await fetchRatings()
    })
    const submitRating = async () => {
      const token = localStorage.getItem('token');
      try {
        await axios.post('http://localhost:8000/api/ratings', {
          film_id: film_id.value,
          rating: rating.value,
          comment: comment.value
        }, {
          headers: { 'Authorization': `Bearer ${token}` }
        });
        await fetchRatings();
      } catch (error) {
        console.error('Erreur lors de la soumission de la notation:', error);
        alert('Une erreur est survenue lors de la soumission de la notation');
      }
    };

    //console.log(submitRating)
    const addToFavorites = async (id) => {
      await addFavorite(id)
      alert('Ce film a été ajouté à votre liste des favories')
    }

    return{
      film,
      storage,
      addToFavorites,
      ratings,
      film_id,
      rating,
      comment,
      submitRating,

    }
  }
}
</script>

<style>
/* CSS VARIABLES */
:root {
  --primary: #141414;
  --light: #F3F3F3;
  --dark: 	#686868;
}

html, body {
  width: 100vw;
  min-height: 100vh;
  margin: 0;
  padding: 0;
  background-color: var(--primary);
  color: var(--light);
  font-family: Arial, Helvetica, sans-serif;
  box-sizing: border-box;
  line-height: 1.4;
}

img {
  max-width: 100%;
}

h1 {
  padding-top: 60px;
}

.wrapper {
  margin: 0;
  padding: 0;
}

/* HEADER */
header {
  padding: 20px 20px 0 20px;
  position: fixed;
  top: 0;
  display: grid;
  grid-gap:5px;
  grid-template-columns: 1fr 4fr 1fr;
  grid-template-areas:
   "nt mn mn sb . . . ";
  background-color: var(--primary);
  width: 100%;
  margin-bottom: 0px;
}

.netflixLogo {
  grid-area: nt;
  object-fit: cover;
  width: 100px;
  max-height: 100%;

  padding-left: 30px;
  padding-top: 0px;
}

.netflixLogo img {
  height: 35px;
}

#logo {
  color: #E50914;
  margin: 0;
  padding: 0;
}


.main-nav {
  grid-area: mn;
  padding: 0 30px 0 20px;
}

.main-nav a {
  color: var(--light);
  text-decoration: none;
  margin: 5px;
}

.main-nav a:hover {
  color: var(--dark);
}

.sub-nav {
  grid-area: sb;
  padding: 0 40px 0 40px;
}

.sub-nav a {
  color: var(--light);
  text-decoration: none;
  margin: 5px;
}

.sub-nav a:hover {
  color: var(--dark);
}


/* MAIN CONTIANER */
.main-container {
  padding: 50px;
}

.box {
  display: grid;
  grid-gap: 20px;
  grid-template-columns: repeat(6, minmax(100px, 1fr));
}

.box a {
  transition: transform .3s;
}

.box a:hover {
  transition: transform .3s;
  -ms-transform: scale(1.4);
  -webkit-transform: scale(1.4);
  transform: scale(1.4);
}

.box img {
  border-radius: 2px;
}

/* LINKS */
.link {
  padding: 50px;
}

.sub-links ul {
  list-style: none;
  padding: 0;
  display: grid;
  grid-gap: 20px;
  grid-template-columns: repeat(4, 1fr);
}

.sub-links a {
  color: var(--dark);
  text-decoration: none;
}

.sub-links a:hover {
  color: var(--dark);
  text-decoration: underline;
}

.logos a{
  padding: 10px;
}

.logo {
  color: var(--dark);
}


/* FOOTER */
footer {
  padding: 20px;
  text-align: center;
  color: var(--dark);
  margin: 10px;
}

/* MEDIA QUERIES */

@media(max-width: 900px) {

  header {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(2, 1fr);
    grid-template-areas:
    "nt nt nt  .  .  . sb . . . "
    "mn mn mn mn mn mn  mn mn mn mn";
  }

  .box {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(4, minmax(100px, 1fr));
  }

}

@media(max-width: 700px) {

  header {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(2, 1fr);
    grid-template-areas:
    "nt nt nt  .  .  . sb . . . "
    "mn mn mn mn mn mn  mn mn mn mn";
  }

  .box {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(3, minmax(100px, 1fr));
  }

  .sub-links ul {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(3, 1fr);
  }

}

@media(max-width: 500px) {

  .wrapper {
    font-size: 15px;
  }

  header {
    margin: 0;
    padding: 20px 0 0 0;
    position: static;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(1, 1fr);
    grid-template-areas:
    "nt"
    "mn"
    "sb";
    text-align: center;
  }

  .netflixLogo {
    max-width: 100%;
    margin: auto;
    padding-right: 20px;
  }

  .main-nav {
    display: grid;
    grid-gap: 0px;
    grid-template-columns: repeat(1, 1fr);
    text-align: center;
  }

  h1 {
    text-align: center;
    font-size: 18px;
  }



  .box {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(1, 1fr);
    text-align: center;
  }

  .box a:hover {
    transition: transform .3s;
    -ms-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1.2);
  }

  .logos {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(2, 1fr);
    text-align: center;
  }

  .sub-links ul {
    display: grid;
    grid-gap: 20px;
    grid-template-columns: repeat(1, 1fr);
    text-align: center;
    font-size: 15px;
  }





}
</style>