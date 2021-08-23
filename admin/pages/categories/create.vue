<template>
  <div class="container">
    <h1>Add New Category</h1>
    <CategoriesForm />
  </div>
</template>

<script>
export default {
  middleware: 'auth',
}
</script>
