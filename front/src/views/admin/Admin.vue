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
              <th>Affiche</th>
              <th>Actions</th>

            </tr>
          </thead>
          <tbody v-if="films">
            <tr v-for="film in films.films" :key="film.id">
              <td>{{film.titre}}</td>
              <td>{{film.description}}</td>
              <td><img :src="film.affiche" width="40px"></td>
              <td>
                <a class="btn btn-danger" @click="onDelete(film.id)">Delete</a>
              </td>

            </tr>
          </tbody>
        </table>

      </div>

    </div>
    <Footer/>
</template>

<script lang="ts">
import NavTab from "@/components/NavTab.vue";
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import {onMounted, ref} from "vue";

import {Films} from "@/interfaces/films";

export default {
  name: "Admin",
  components: {
    NavTab,
    Header,
    Footer
  },

  setup(){
    onMounted(async () => {
      const r = await fetch('http://localhost:8000/api/films')
      films.value = await r.json()
      //console.log(films.value.films)

    })

    const onDelete = async (id) => {
      if(confirm('Êtes-vous sûre de vouloir supprimé ce produit')) {
        await fetch(`http://localhost:8000/api/films/${id}`, {
          method: 'DELETE',
        })
        films.value = films.value.films.filter((f: Films)=>f.id!==id)
        //console.log(films.value)

      }
    }

    const films = ref([])

    return{
      films,
      onDelete
    }
  }

}
</script>

<style scoped>

</style>