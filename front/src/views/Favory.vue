<template>
  <Header/>

  <!-- MAIN CONTAINER -->
  <section class="main-container" >
    <div class="location" id="home" >
      <h1 id="home" >Favorites on MyFlix</h1>
      <div  class="row">
        <div class="col-md-4 mx-3 box">

        <div v-for="favorite in favorites[0]" :key="favorite.id" class="card" style="width: 18rem;">
            <router-link :to="`/show/${favorite.film.titre}-${favorite.film.id}`" >
              <video :src="`http://localhost:8000/storage/${favorite.film.film}`" width="200px" height="200px"></video>
            </router-link>
          <div class="card-body">
<!--            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
            <button class="btn btn-primary" @click="removeFromFavory(favorite.id)">Supprimer</button>
          </div>
        </div>

        </div>
      </div>
    </div>
  </section>
  <!-- END OF MAIN CONTAINER -->
  <Footer/>
</template>
<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import {onMounted, ref} from "vue";
import {getFavorites, removeFavorite} from "@/services/favoriteService.js";

export default {
  name: "Favory",
  components: {Footer, Header},
  setup(){
    const favorites = ref([])
    onMounted(async () => {
       favorites.value = await getFavorites()
      //console.log(favorites.value)
    })

    const removeFromFavory = async (id) =>{
      if(confirm("Êtes-vous sûre de vouloir suppprimé ce film de la liste des favories")){
        await removeFavorite(id)
      }
    }
      //console.log(remove)
    return {
      favorites,
      removeFromFavory
    }
  }
}
</script>