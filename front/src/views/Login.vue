<script>
import {ref} from "vue";
import {useRouter} from "vue-router";

export default {
  name: "Login",
  setup(){
    const email = ref('')
    const password = ref('')
    const router = useRouter()
    const onLogin = async () => {
      const r = await fetch('http://localhost:8000/api/login',{
        method:"POST",
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({
          email : email.value,
          password : password.value
        })
      })
      const data = await r.json()
        console.log(data.token)
      if(data.token)
      {
        localStorage.setItem('token',data.token)
        await router.push('/home')
      }else {
        alert('Authentification échoué')
      }
    }
  return{
    email,
    password,
    onLogin
  }
  }
}
</script>

<template>
  <div class="wrapper">
    <div class="header">
      <svg viewBox="0 0 512 138" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid">
        <g>
          <path d="M340.657183,0 L340.657183,100.203061 C353.016406,100.778079 365.344207,101.473198 377.637095,102.293306 L377.637095,123.537553 C358.204486,122.242243 338.690182,121.253471 319.094879,120.57923 L319.094879,0 L340.657183,0 Z M512,0.0118710746 L483.922918,65.1060972 L511.993017,137.54371 L511.961595,137.557485 C503.784957,136.3909 495.597845,135.289637 487.386294,134.233936 L471.623048,93.5776798 L455.709676,130.459835 C448.168455,129.627123 440.61676,128.839275 433.047609,128.100899 L460.419447,64.6708546 L435.351871,0.0118710746 L458.677285,0.0118710746 L472.712335,36.1957639 L488.318473,0.0118710746 L512,0.0118710746 Z M245.093161,119.526252 L245.092462,0.0114869428 L305.282574,0.0114869428 L305.282574,21.4467074 L266.654767,21.4467074 L266.654767,49.2277266 L295.881884,49.2277266 L295.881884,70.4719734 L266.654767,70.4719734 L266.654767,119.521329 L245.093161,119.526252 Z M164.580156,21.448488 L164.579458,0.0103695593 L231.270382,0.0103695593 L231.270382,21.4469875 L208.705375,21.4469875 L208.705375,120.107799 C201.508397,120.296154 194.3191,120.519389 187.144466,120.790104 L187.144466,21.448488 L164.580156,21.448488 Z M90.8682168,126.966224 L90.8682168,0.0139657936 L150.758077,0.0139657936 L150.758077,21.4491862 L112.42703,21.4491862 L112.42703,50.4849807 C121.233151,50.3722116 133.754021,50.2444297 141.543822,50.2632828 L141.543822,71.5092753 C131.792954,71.388127 120.786264,71.6429923 112.42703,71.7264345 L112.42703,103.88974 C125.166805,102.887736 137.944984,102.011069 150.758077,101.270912 L150.758077,122.517253 C130.704017,123.672422 110.740031,125.160591 90.8682168,126.966224 Z M48.5710466,77.8540254 L48.5696502,0.0104745953 L70.1319549,0.0104745953 L70.1319549,128.968837 C62.2496338,129.779728 54.3823252,130.642465 46.5286328,131.553346 L21.5609083,59.8244682 L21.5609083,134.625696 C14.3597408,135.563565 7.17323695,136.54141 0,137.562338 L0,0.0118710746 L20.4911722,0.0118710746 L48.5710466,77.8540254 Z M395.425298,124.819071 L395.425298,124.819211 L395.425298,0.0120101224 L416.987603,0.0120101224 L416.987603,126.599777 C409.809478,125.960833 402.624371,125.369895 395.425298,124.819071 Z" fill="#DB202C" fill-rule="nonzero"></path>
        </g>
      </svg>
    </div>

    <div class="login">
      <form @submit.prevent="onLogin" class="signin-form">
        <h1 class="title">Sign In</h1>

        <div class="field">
          <input type="text" v-model="email" name="email" class="text-input" placeholder="Email address" required />
        </div>

        <div class="field">
          <input type="password" v-model="password" name="password" class="text-input" placeholder="Password" required />
        </div>

        <button class="signin-btn btn-danger btn">Sign In</button>


      </form>
    </div>


  </div>

</template>

<style scoped>
$primary: #db202c;
$error: orangered;
$font_color: #989897;
$border_radius: 5px;

%extend {
  top: 8px;
  bottom: 10px;
  left: 20px;
  font-size: 11px;
  opacity: 1;
}

* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
}

body {
  margin: 0;
  width: 100vw;
  min-height: 1050px;
  position: relative;
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
  linear-gradient(to top, rgba(0, 0, 0, 0) 90%, rgba(0, 0, 0, 0.5)),
  url(https://i.postimg.cc/NjHjKtG4/US-en-20190128-popsignuptwoweeks-perspective-alpha-website-large.jpg);
  background-position: center center;
  background-size: cover;
  background-repeat: no-repeat;
}

a {
  cursor: pointer;
  &:hover {
    text-decoration: underline;
  }
}

.wrapper {
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.header {
  width: 100%;
  padding: 20px 40px;
  svg {
    width: 160px;
  }
}

.login {
  width: 425px;
  height: 650px;
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  background: rgba(0, 0, 0, 0.7);
  border-radius: $border_radius;
  .signin-form {
    margin-top: 30px;
    width: 70%;
    position: relative;
    height: 100%;
    .title {
      color: white;
    }
    .signin-btn {
      margin-top: 30px;
      width: 100%;
      padding: 13px 0;
      border-radius: $border_radius;
      border: none;
      background: $primary;
      color: white;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
    }
    .action-group {
      margin-top: 8px;
      width: 100%;
      display: flex;
      justify-content: space-between;
      color: $font_color;
      font-size: 13px;
      input {
        -ms-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -webkit-transform: scale(1.2);
        -o-transform: scale(1.2);
        padding: 10px;
      }
    }
    .onboarding {
      bottom: 0;
      margin-bottom: 50px;
      position: absolute;
      color: $font_color;
      div {
        display: flex;
        align-items: center;
        .icon {
          display: flex;
          svg {
            width: 20px;
            height: 20px;
          }
        }
        small {
          padding-left: 5px;
        }
      }
      p {
        margin: 10px 0 0 0;
        display: block;
      }
      a {
        color: white;
      }
    }
  }
}

.field {
  position: relative;
}

.field input {
  background: #333333;
  color: white;
  font-size: 14px;
  width: 100%;
  height: 45px;
  margin: 5px 0;
  border: none;
  border-radius: $border_radius;
  padding: 15px 0 0 20px;
  outline: none;
  &:focus ~ .floating-label {
    @extend %extend;
  }
  &:not(:focus):valid ~ .floating-label {
    @extend %extend;
  }
  &.invalid {
    border-bottom: 2px solid $error;
  }
}

.floating-label {
  position: absolute;
  pointer-events: none;
  left: 20px;
  top: 18px;
  transition: 0.2s ease all;
  color: $font_color;
}

.error-message {
  color: $error;
  margin: 0;
  font-size: 13px;
  width: 100%;
}

.footer {
  position: absolute;
  bottom: 0;
  height: 220px;
  width: 100%;
  flex-shrink: 0;
  background: rgba(0, 0, 0, 0.84);
  padding: 20px 30px;
  color: $font_color;
  .terms {
    margin-top: 30px;
    a {
      font-size: 12px;
      padding-right: 100px;
    }
  }
  select {
    margin-top: 30px;
    height: 40px;
    background: black;
    border: 1px solid red;
    color: $font_color;
    outline: none;
    border-radius: $border_radius;
    padding: 10px 20px;
  }
}

</style>