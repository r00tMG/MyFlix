<script>
import Navbar from "@/components/Navbar.vue";

export default {
  name: "Header",
  components: {Navbar}
}
</script>

<template>
  <header>
    <div class="netflixLogo">
      <router-link to="/" id="logo" class="text-link texy-decoration-none" href="#home">
        MyFlix
      </router-link>
    </div>
    <Navbar/>
  </header>
</template>

<style scoped>

</style>