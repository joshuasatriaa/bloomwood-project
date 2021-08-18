<template>
  <div class="container">
    <h1 class="mb-4">Product List</h1>
    <ProductsTable v-if="products" :products="products" />
    <div class="col-12 col-md-6 d-flex justify-content-end ms-auto">
      <BasePagination
        getter="products/PRODUCTS"
        action="products/GET_PRODUCTS"
      />
    </div>
  </div>
</template>

<script>
import { useGetProducts } from '@/composables/useProduct'
export default {
  setup() {
    const { products } = useGetProducts()
    return { products }
  },
}
</script>

<style></style>
