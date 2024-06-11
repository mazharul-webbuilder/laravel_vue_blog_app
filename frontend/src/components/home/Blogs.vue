<template>
  <div class="mt-4">
    <h5>Create | Edit  Blog</h5>
    <div class="">
      <div class="">
        <p v-if="error.title" class="text-danger">{{error.title}}</p>
        <input type="text" placeholder="Enter Blog Title" class="form-control w-full" v-model="model.blog.title">
      </div>
      <div class="mt-3">
        <p v-if="error.content" class="text-danger">{{error.content}}</p>
        <textarea class="form-control" placeholder="Enter Blog content" v-model="model.blog.content"></textarea>

      </div>
      <div class="flex justify-content-evenly float-end">
        <button class="btn btn-success mt-3" @click.prevent="storeOrUpdateBlog(model.blog.id)">Save</button>
      </div>
    </div>
  </div>
  <!--Blogs section  -->
  <div class="" v-if="getLoader">
    <Loader></Loader>
  </div>
  <div class="mt-4" v-else>
    <h6>Blogs</h6>
    <div class="py-2" v-for="blog in blogs" :key="blog.id" v-if="blogs">
      <div class="d-flex justify-content-between">
        <p><strong>{{blog.title}}</strong></p>
        <div class="">
          <button type="button" class="btn btn-secondary" @click.prevent="editPost(blog.id)">Edit</button>
          <button type="button" class="btn btn-danger ms-1" @click.prevent="deletePost(blog.id)">Delete</button>
        </div>
      </div>
      <p>{{blog.content}}</p>
      <p><i>Creation Date {{blog.creation_date}}</i></p>
    </div>
    <div class="" v-else>
      <p class="text-center">You have no blogs to show.</p>
    </div>
  </div>

</template>
<script>
import axios from "@/axios.js";
import {mapActions, mapState} from "pinia";
import {useBlogStore} from "@/stores/BlogStore.js";
import {useLoaderStore} from "@/stores/LoaderStore.js";
import Loader from "@/components/loader/Loader.vue";

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
      },
      error:{
        title: '',
        content: ''
      }
    }
  },
  components: {
    Loader
  },
  mounted() {
    this.getBlogs()
  },
  computed: {
    ...mapState(useLoaderStore, {
      getLoader: "getLoader"
    })
  },
  methods: {
    ...mapActions(useBlogStore, {
      setBlog: "setBlog"
    }),
    ...mapActions(useLoaderStore, {
      invertLoader: "invertLoader"
    }),
     getBlogs(){
      axios.get('/posts').then((res) => {
        this.blogs = res.data.data
      }).catch((error) => {

      }).finally(() => {
        this.invertLoader()
      })
    },
    editPost(blogId){
      this.error.title = ''
      this.error.content = ''
      axios.get(`/posts/${blogId}`).then((res) => {
        this.model.blog.id = res.data.data.id
        this.model.blog.title = res.data.data.title
        this.model.blog.content = res.data.data.content
      })
    },
    storeOrUpdateBlog(blogId){
      // Update blog
      if (blogId){
        this.error.title = ''
        this.error.content = ''
        axios.put(`/posts/${blogId}`, this.model.blog)
            .then((res) => {
              this.getBlogs()
              this.makeFormEmpty()
            })
            .catch((error) => {
              if(error.response.status === 422){
                this.showErrors(error)
              }
            })
      }
      // Store new blog
      else {
        this.error.title = ''
        this.error.content = ''
        axios.post('/posts', this.model.blog)
            .then((res) => {
              this.makeFormEmpty()
              this.getBlogs()
            })
            .catch((error) => {
              if(error.response.status === 422){
                this.showErrors(error)
              }
            })
      }
    },
    makeFormEmpty(){
      this.model.blog.title = ''
      this.model.blog.content = ''
      this.model.blog.id = ''
    },
    showErrors(error){
      if (error.response.data.errors.title){
        this.error.title = error.response.data.errors.title[0]
      }
      if (error.response.data.errors.content){
        this.error.content = error.response.data.errors.content[0]
      }
    },
    deletePost(blogId){
      if (confirm('Are you sure, want to delete this blog?')){
        axios.delete(`posts/${blogId}`).then((res) => {
          this.getBlogs()
        }).catch((error) => {

        })
      }
    }
  }

}
</script>