<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import Router from "@/router/index.js";

export default {
  name: "CreateFilms",
  components: { Footer, Header },
  setup() {
    const titre = ref('azerty');
    const genre = ref('azerty');
    const description = ref('azerty');
    const realisateur = ref('azerty');
    const date_de_sortie = ref('');
    const duree = ref('123')
    const affiche = ref(null);
    const film = ref(null)

    const router = useRouter();

    const onFilmChange = (event) => {
      film.value = event.target.files[0]
      console.log(film.value)
    };
    const onAfficheChange = (event) => {
      affiche.value = event.target.files[0];
      console.log(affiche.value)
    };

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
        const response = await axios.post('http://localhost:8000/api/films', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'Authorization': `Bearer ${token}`
          }
        });

        console.log(response.data);
        //const r = response.data
        //console.log(r[0])
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
      onFilmChange,
      onAfficheChange,
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
        <input class="form-control" type="file" @change="onFilmChange" name="film" placeholder="Réalisateur" >
      </div>
      <div class="form-group mb-3">
        <input class="form-control btn btn-primary" type="submit" value="Save" >
      </div>
    </form>
  </div>
  <Footer />
</template>

<style scoped>
</style>
