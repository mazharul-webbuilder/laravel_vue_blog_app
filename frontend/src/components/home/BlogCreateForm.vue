<template>
  <div class="mt-4">
    <h5>Create | Edit  Blog</h5>
    <div class="">
      <div class="">
        <input type="text" placeholder="Enter Blog Title" class="form-control w-full">
      </div>
      <div class="mt-3">
        <textarea class="form-control" placeholder="Enter Blog content"></textarea>
      </div>
      <div class="flex justify-content-evenly float-end">
        <button class="btn btn-success mt-3">Save</button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'BlogCreateForm'
}
</script>