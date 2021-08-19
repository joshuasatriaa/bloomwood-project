<template>
  <div class="container">
    <h1>Add New Product</h1>
    <ProductsForm />
  </div>
</template>

<script>
export default {
  middleware: 'auth',
}
</script>
