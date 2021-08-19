<template>
  <div class="container">
    <h1>Edit Product</h1>
    <ProductsForm v-if="product.data" :is-update="true" :product="product" />
  </div>
</template>

<script>
import { useGetProduct } from '@/composables/useProduct'
export default {
  middleware: 'auth',
  setup() {
    const { product } = useGetProduct()

    return { product }
  },
}
</script>

<style></style>
