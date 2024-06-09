<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card py-8 my-5">
          <div class="card-header">
            <h3 class="mb-0">Login</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="login">
              <p v-if="unAuthenticatedMessage" class="text-center text-white rounded" style="background-color: #897d3a">{{unAuthenticatedMessage}}</p>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" v-model="model.requestData.email">
                <p v-if="errors.email" class="text-danger">{{errors.email[0]}}</p>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" v-model="model.requestData.password">
                <p v-if="errors.password" class="text-danger">{{errors.password[0]}}</p>
              </div>
              <button type="submit" class="btn btn-primary mt-2">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "@/axios.js";
import {useAuthStore} from "@/stores/AuthStore.js";
import {mapActions} from "pinia";
import router from "@/router/index.js";

export default {
  name: "LoginView",
  data() {
    return {
      model: {
        requestData: {
          email: '',
          password: ''
        }
      },
      errors: '',
      unAuthenticatedMessage: ''
    };
  },
  methods: {
    ...mapActions(useAuthStore, {
      setAccessToken: "setAccessToken",
      setAccessTokenToLocalStorage: "setAccessTokenToLocalStorage",
      setUser: "setUser"
    }),
    login() {
      axios.post('/login', this.model.requestData)
          .then( (res) => {
            this.setAccessToken(res.data.accessToken)
            this.setAccessTokenToLocalStorage(res.data.accessToken)
            this.resetForm();
            // Redirect to the home
            router.push('/');
          })
          .catch((error) => {
            if (error) {
              if (error.response.status === 422) {
                this.errors = error.response.data.errors
                this.unAuthenticatedMessage = ''
              } else if(error.response.status === 401) {
                this.errors = ''
                this.unAuthenticatedMessage = "Credential's not matched"
              }
            }
          })
    },
    resetForm() {
      // Reset the form fields
      Object.keys(this.model.requestData).forEach((key) => {
        this.model.requestData[key] = "";
      });
      // Reset errors
      this.errors = {};
    }
  }
};
</script>