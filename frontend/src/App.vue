<template>
 <div class="container">
   <app-header></app-header>
   <router-view></router-view>
   <app-footer></app-footer>
 </div>
</template>

<script>
import AppHeader from '@/components/layout/Header.vue'
import AppFooter from '@/components/layout/Footer.vue'
export default {
  name: 'App',
  data(){

  },
  components: {
    AppHeader,
    AppFooter
  },
  computed:{

  }
}
</script>