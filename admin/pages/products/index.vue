<template>
  <div class="container">
    <h1 class="mb-4">Product List</h1>
    <div class="row">
      <div class="col text-end">
        <NuxtLink to="/products/create" class="btn btn-success text-white mb-4"
          >Add New Product</NuxtLink
        >
      </div>
    </div>
    <BaseSearch :callback="getProducts" />
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
  middleware: 'auth',
  setup() {
    const { products, getProducts } = useGetProducts()
    return { products, getProducts }
  },
}
</script>

<style></style>
