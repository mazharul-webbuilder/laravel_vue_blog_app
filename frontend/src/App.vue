<template>
 <div class="container">
   <app-header></app-header>
   <router-view></router-view>
   <p v-if="loading"></p>
   <app-footer v-else></app-footer>
 </div>
</template>

<script>
import AppHeader from '@/components/layout/Header.vue'
import AppFooter from '@/components/layout/Footer.vue'
import Loader from "@/components/loader/Loader.vue";
export default {
  name: 'App',
  data(){
    return {
      loading: true
    }
  },
  components: {
    AppHeader,
    AppFooter,
    Loader
  },
  mounted() {
    setTimeout(() => {
      this.loading = false
    }, 2000)
  },
  computed:{

  }
}
</script>