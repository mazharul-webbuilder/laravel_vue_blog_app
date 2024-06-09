<template>
  <div class="mt-4">
    <h5>Create | Edit  Blog</h5>
    <div class="">
      <div class="">
        <input type="text" placeholder="Enter Blog Title" class="form-control w-full" v-model="getBlog.title">
      </div>
      <div class="mt-3">
        <textarea class="form-control" placeholder="Enter Blog content" v-model="getBlog.content"></textarea>
      </div>
      <div class="flex justify-content-evenly float-end">
        <button class="btn btn-success mt-3">Save</button>
      </div>
    </div>
  </div>
</template>
<script>
import {mapState} from "pinia";
import {useBlogStore} from "@/stores/BlogStore.js";

export default {
  name: 'BlogCreateForm',
  data(){
    return{
      blog:{
        title: '',
        content: ''
      }
    }
  },
  computed:{
    ...mapState(useBlogStore, {
      getBlog: "getBlog"
    })
  },
}
</script>