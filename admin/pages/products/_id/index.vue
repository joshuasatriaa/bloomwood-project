<template>
  <div class="container">
    <h1>Product Details</h1>
    <NuxtLink
      :to="`/products/${$route.params.id}/edit`"
      class="btn btn-success text-white px-4"
      >Edit</NuxtLink
    >
    <div v-if="product.data">
      <div class="row mt-4">
        <div
          v-if="product.data.images.length > 0"
          class="col bg-secondary shadow rounded-3"
        >
          <ProductsCarousel />
        </div>
        <h3 v-else class="text-danger text-center fw-bold">No Image Found</h3>
      </div>
      <div class="row mt-7">
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
