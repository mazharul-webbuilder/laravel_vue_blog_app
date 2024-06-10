<template>
  <div class="mt-4">
    <h6>Blogs</h6>
    <div class="py-2" v-for="blog in blogs" :key="blog.id" v-if="blogs">
      <div class="d-flex justify-content-between">
        <p><strong>{{blog.title}}</strong></p>
        <button type="button" class="btn btn-secondary" @click.prevent="editPost(blog.id)">Edit</button>
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
import {mapActions} from "pinia";
import {useBlogStore} from "@/stores/BlogStore.js";

export default {
  name: 'Blogs',
  data(){
    return{
      blogs: '',
    }
  },
  mounted() {
    this.getBlogs()
  },
  methods: {
    ...mapActions(useBlogStore, {
      setBlog: "setBlog"
    }),
    getBlogs(){
      axios.get('/posts').then((res) => {
        this.blogs = res.data.data
      })
    },
    editPost(blogId){
      axios.get(`/posts/${blogId}`).then((res) => {
        this.setBlog(res.data.data.title, res.data.data.content)
      })
    }
  }

}
</script>