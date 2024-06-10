<template>
  <div class="mt-4">
    <h5>Create | Edit  Blog</h5>
    <div class="">
      <div class="">
        <input type="text" placeholder="Enter Blog Title" class="form-control w-full" v-model="model.blog.title">
      </div>
      <div class="mt-3">
        <textarea class="form-control" placeholder="Enter Blog content" v-model="model.blog.content"></textarea>
      </div>
      <div class="flex justify-content-evenly float-end">
        <button class="btn btn-success mt-3" @click.prevent="storeOrUpdateBlog(model.blog.id)">Save</button>
      </div>
    </div>
  </div>
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
      model: {
        blog:{
          id: '',
          title: '',
          content: ''
        }
      }
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
        this.model.blog.id = res.data.data.id
        this.model.blog.title = res.data.data.title
        this.model.blog.content = res.data.data.content
      })
    },
    storeOrUpdateBlog(blogId){
      if (blogId){

      } else {

      }
    }
  }

}
</script>