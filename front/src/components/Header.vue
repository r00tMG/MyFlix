<script>
import Navbar from "@/components/Navbar.vue";
import {ref} from "vue";

export default {
  name: "Header",
  components: {Navbar},

}
</script>

<template>
  <header>
    <div class="netflixLogo">
      <router-link to="/" id="logo" class="text-link text-decoration-none" href="#home">
        <strong class="fs-4">MyFlix</strong>
      </router-link>
    </div>
    <Navbar/>
  </header>
</template>

<style scoped>

</style>