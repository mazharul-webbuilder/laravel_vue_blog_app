<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">DevForest</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link class="nav-link active" aria-current="page" :to="{name: 'home'}">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/">About</router-link>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
          <button class="btn btn-outline-secondary ms-2" v-if="isAuthenticated" @click.prevent="logout()">Logout</button>
        </form>
      </div>
    </div>
  </nav></template>
<script>
import axios from "@/axios.js";
import {mapActions, mapState} from "pinia";
import {useAuthStore} from "@/stores/AuthStore.js";
import router from "@/router/index.js";

export default {
  name: 'AppHeader',
  methods: {
    ...mapActions(useAuthStore,{
      removeAccessToken: "removeAccessToken"
    }),
    logout(){
      axios.post('/logout').then( (res) => {
        if (res.data.out){
          this.removeAccessToken()
          router.push('/login')
        }
      })
    }
  },
  computed:{
    ...mapState(useAuthStore, {
      isAuthenticated: "isAuthenticated"
    })
  }
}
</script>