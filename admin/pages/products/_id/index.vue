<template>
  <div class="container">
    <h1>Product Details</h1>
    <div v-if="product.data">
      <div class="row mt-4">
        <div class="col bg-secondary shadow rounded-3">
          <ProductsCarousel />
        </div>
      </div>
      <div class="row mt-4">
        <h2 class="border-start border-4 border-primary">Product Name</h2>
        <p class="m-0 fw-bold">{{ product.data.name }}</p>
      </div>
      <div class="row mt-4">
        <h2 class="border-start border-4 border-primary">Description</h2>
        <p class="m-0 fw-bold">{{ product.data.description }}</p>
      </div>
      <div class="row mt-4">
        <h2 class="border-start border-4 border-primary">Categories</h2>
        <p
          v-for="category in product.data.categories"
          :key="category.id"
          class="m-0 fw-bold"
        >
          - {{ category.name }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import { useGetProduct } from '@/composables/useProduct'
export default {
  setup() {
    const { product } = useGetProduct()
    return { product }
  },
}
</script>

<style></style>
