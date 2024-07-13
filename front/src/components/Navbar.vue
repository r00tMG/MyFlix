<template>
  <nav class="main-nav">
    <router-link to="/home" >Home</router-link>
    <a href="#tvShows">TV Shows</a>
    <a href="#movies">Movies</a>
    <a href="#originals">Originals</a>
    <a href="#">Recently Added</a>
    <a target="_blank" href="https://codepen.io/cb2307/full/NzaOrm">Portfolio</a>
  </nav>
  <nav class="sub-nav">
    <a href="#"><i class="fas fa-search sub-nav-logo"></i></a>
<!--    <router-link class="" @click="onLogout">Logout</router-link>-->
    <router-link to="/" >Login</router-link>
    <router-link to="/register" >Register</router-link>
  </nav>
</template>
<script>
import {useRouter} from "vue-router";
import axios from "axios";

export default {
  name: "Navbar",
  setup(){
    const router = useRouter()
    const onLogout = async () => {
      try {
       await axios.post('http://localhost:8000/api/logout', {}, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
          }
        });
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        await router.push('/');
      } catch (error) {
        console.error('Logout failed', error);
      }
    };
    return {
      onLogout
    }
  }
}
</script>
