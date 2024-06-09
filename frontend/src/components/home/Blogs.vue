<template>
  <div class="mt-4">
    <h6>Blogs</h6>
    <div class="py-2" v-for="blog in blogs" :key="blog.id" v-if="blogs">
      <div class="d-flex justify-content-between">
        <p><strong>{{blog.title}}</strong></p>
        <button type="button" class="btn btn-secondary">Edit</button>
      </div>
      <p>{{blog.content}}</p>
    </div>
    <div class="" v-else>
      <p class="text-center">You have no blogs to show.</p>
    </div>
  </div>
</template>
<script>
import axios from "@/axios.js";

export default {
  name: 'Blogs',
  data(){
    return{
      blogs: ''
    }
  },
  mounted() {
    this.getBlogs()
  },
  methods: {
    getBlogs(){
      axios.get('/posts').then((res) => {
        this.blogs = res.data.data
      })
    }
  }

}
</script>