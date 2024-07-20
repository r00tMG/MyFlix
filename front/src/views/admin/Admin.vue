<template>
  <Header/>
  <div class="container-fluid my-5">
    <div class="container w-75 my-5 m-auto">
      <NavTab/>
      <div class="d-flex my-5 justify-content-between">
        <router-link to="/admin/create" class="btn btn-outline-primary">Create</router-link>
        <h3 class="">Liste des films</h3>
      </div>
      <table class="table table-bordered table-responsive">
        <thead>
        <tr>
          <th>Titre</th>
          <th>Description</th>
          <th>Réalisation</th>
          <th>Affiche</th>
          <th>Film</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody >
        <tr v-if="films" v-for="film in films" :key="film.id">
          <td v-text="film.titre"></td>
          <td v-text="film.description "></td>
          <td v-text="film.realisateur"></td>
          <td>
            <img :src="film.storage + '/' + film.affiche" width="60px">
          </td>
          <td>
            <video controls :src="film.storage + '/' + film.film" width="100px"></video>
          </td>
          <td>
            <button class="btn btn-danger me-2" @click="onDelete(film.id)">Delete</button>
            <router-link :to="`/admin/${film.id}/edit`" class="btn btn-success">Edit</router-link>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
  <Footer/>
</template>

<script>
import NavTab from "@/components/NavTab.vue";
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import { onMounted, ref } from "vue";
import axios from "@/axios.js";

export default {
  name: "Admin",
  components: {
    NavTab,
    Header,
    Footer
  },
  setup() {
    const films = ref([]);

    onMounted(async () => {
      const token = localStorage.getItem('token');
      const response = await axios.get('/films', {
        headers: {
          'Content-Type' : 'application/json',
          'Authorization': `Bearer ${token}`
        }
      });
      /*films.value = response.data.films.map(film => ({
        ...film,
        affiche_url: `http://localhost:8000/storage/${film.affiche}`,
        film_url: film.storage + film.film
      }));*/
      films.value = response.data.films
      console.log(films.value)


    });

    const onDelete = async (id) => {
      if (confirm('Êtes-vous sûr de vouloir supprimer ce film ?')) {
        const token = localStorage.getItem('token');
        await axios.delete(`/films/${id}`, {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });
        films.value = films.value.filter(film => film.id !== id);
      }
    };

    return {
      films,
      onDelete,
    };
  }
};
</script>

<style scoped>
</style>
