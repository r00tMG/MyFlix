<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";

export default {
  name: "CreateFilms",
  components: {Footer, Header},
  setup(){
    const titre = ref('')
    const genre = ref('')
    const description = ref('')
    const realisateur = ref('')
    const date_de_sortie = ref('')
    const duree = ref('')
    const affiche = ref('')
    const router = useRouter()
    const onSubmit = async () => {
      const r = await fetch('http://localhost:8000/api/films',{
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({
          titre:titre.value,
          genre:genre.value,
          description:description.value,
          realisateur:realisateur.value,
          date_de_sortie:date_de_sortie.value,
          duree:duree.value,
          affiche:affiche.value,

        })
      })
      console.log(await r.json())
      await router.push('/admin')
    }
    return {
      titre,
      genre,
      description,
      realisateur,
      date_de_sortie,
      duree,
      affiche,
      onSubmit
    }

  }
}
</script>

<template>
  <Header/>
<!--  $table->string('titre');
  $table->string('genre');
  $table->text('description')->nullable();
  $table->string('realisateur');
  $table->date('date_de_sortie');
  $table->integer('duree');
  $table->string('affiche')->nullable();-->
    <div class="container my-5 w-75">
      <form @submit.prevent="onSubmit" class="my-5" enctype="multipart/form-data">
        <div class="form-group">
          <input class="form-control" type="text" v-model="titre" name="titre"  >
        </div>
        <div class="form-group">
          <input class="form-control" type="text" v-model="description" name="description"  >
        </div>
        <div class="form-group">
          <input class="form-control" type="file" v-model="affiche" name="affiche" />
        </div>
        <div class="form-group">
          <input class="form-control" type="text" v-model="realisateur" name="realisateur"  >
        </div>
        <div class="form-group">
          <input class="form-control" type="text" v-model="date_de_sortie" name="date_de_sortie"  >
        </div>
        <div class="form-group">
          <input class="form-control" type="text" v-model="duree" name="duree"  >
        </div>

        <div class="form-group">
          <input class="form-control btn btn-primary" value="Save"  >
        </div>

      </form>
    </div>
  <Footer/>
</template>

<style scoped>

</style>