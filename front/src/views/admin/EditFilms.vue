<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import {onMounted, ref} from "vue";
import {useRoute, useRouter} from "vue-router";
import axios from "axios";
import Router from "@/router/index.js";

export default {
  name: "EditFilms",
  components: { Footer, Header },
  setup() {
    const titre = ref('');
    const genre = ref('');
    const description = ref('');
    const realisateur = ref('');
    const date_de_sortie = ref('');
    const duree = ref('')
    const affiche = ref(null);
    const film = ref(null)

    const router = useRouter();
    const route = useRoute()

    const onFilmChange = (event) => {
      film.value = event.target.files[0]
      console.log(film.value)
    };
    const onAfficheChange = (event) => {
      affiche.value = event.target.files[0];
      console.log(affiche.value)
    };
    onMounted( async () => {
      const token = localStorage.getItem('token')
      const r = await axios.get(`http://localhost:8000/api/films/${route.params.id}`,{
        headers:{
          'Authorization':`Bearer ${token}`
        }
      })
      const film = await r.data
      console.log(film)
      titre.value = film[0].titre
      genre.value = film[0].genre
      description.value = film[0].description
      realisateur.value = film[0].realisateur
      date_de_sortie.value = film[0].date_de_sortie
      duree.value = film[0].duree
      film.value = film[0].film
      affiche.value = film[0].affiche


    })

    const onSubmit = async () => {
      const formData = new FormData();
      formData.append('titre', titre.value);
      formData.append('genre', genre.value);
      formData.append('description', description.value);
      formData.append('realisateur', realisateur.value);
      formData.append('date_de_sortie', date_de_sortie.value);
      formData.append('duree', duree.value);
      if (affiche.value) {
        formData.append('affiche', affiche.value);
      }
      if(film.value){
        formData.append('film', film.value)
      }

      for (let [key, value] of formData.entries()) {
        console.log(key, value);
      }

      try {
        const token = localStorage.getItem('token');
        const response = await axios.put(`http://localhost:8000/api/films/${route.params.id}`, formData, {
          method:'PUT',
          headers: {
            'Content-Type':'application/json',
            'Authorization': `Bearer ${token}`
          }
        });

        console.log(response.data);
        //const r = response.data
        await router.push('/admin');

      } catch (error) {
        console.error("There was an error!", error.response.data);
      }
    };


    return {
      titre,
      genre,
      description,
      realisateur,
      date_de_sortie,
      duree,
      affiche,
      film,
      onAfficheChange,
      onFilmChange,
      onSubmit,

    };
  }
};
</script>

<template>
  <Header />
  <div class="container my-5 w-50">
    <form @submit.prevent="onSubmit" class="my-5" enctype="multipart/form-data">
      <div class="form-group mb-3">
        <input class="form-control" type="text" v-model="titre" value="azerty" name="titre" placeholder="Titre" >
      </div>
      <div class="form-group mb-3">
        <input class="form-control" type="text" v-model="genre" value="azerty" name="genre" placeholder="Genre" >
      </div>
      <div class="form-group mb-3">
        <textarea class="form-control" v-model="description"  name="description" placeholder="Description"></textarea>
      </div>
      <div class="form-group mb-3">
        <input class="form-control" type="file" @change="onAfficheChange"  name="affiche" />
      </div>
      <div class="form-group mb-3">
        <input class="form-control" type="text" v-model="realisateur" name="realisateur" placeholder="Réalisateur" >
      </div>
      <div class="form-group mb-3">
        <input class="form-control" type="date" v-model="date_de_sortie" name="date_de_sortie" placeholder="Durée en minutes" >
      </div>
      <div class="form-group mb-3">
        <input class="form-control" type="number" v-model="duree" name="duree" placeholder="Durée en minutes" >
      </div>
      <div class="form-group mb-3">
        <input class="form-control" type="file" @change="onFilmChange" name="film" >
      </div>
      <div class="form-group mb-3">
        <input class="form-control btn btn-primary" type="submit" value="Modifier" >
      </div>
    </form>
  </div>
  <Footer />
</template>

<style scoped>
</style>
