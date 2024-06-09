<template>
  <BlogCreateForm></BlogCreateForm>
  <Blogs></Blogs>

</template>

<script>
import BlogCreateForm from "@/components/home/BlogCreateForm.vue";
import Blogs from "@/components/home/Blogs.vue";
export default {
  name: "HomeView",
  data(){

  },
  components: {
    BlogCreateForm,
    Blogs
  },
  computed: {

  },
  mounted() {
  }
}
</script>