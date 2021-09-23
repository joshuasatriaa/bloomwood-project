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
        <h3 class="border-start border-4 border-primary fw-bold text-uppercase">
          Product Name
        </h3>
        <p class="m-0">{{ product.data.name }}</p>
      </div>
      <div class="row mt-4">
        <h3 class="border-start border-4 border-primary fw-bold text-uppercase">
          Description
        </h3>
        <p class="m-0">{{ product.data.description }}</p>
      </div>
      <div class="row mt-4">
        <h3 class="border-start border-4 border-primary fw-bold text-uppercase">
          Categories
        </h3>
        <p
          v-for="category in product.data.categories"
          :key="category.id"
          class="m-0"
        >
          - {{ category.name }}
        </p>
      </div>
      <div class="row mt-4">
        <h3 class="border-start border-4 border-primary fw-bold text-uppercase">
          Sizes
        </h3>
        <p v-for="(size, index) in product.data.sizes" :key="index" class="m-0">
          - {{ size.name }} -- {{ $currencyFormat(size.price) }}
        </p>
      </div>
      <div class="row mt-4">
        <h3 class="border-start border-4 border-primary fw-bold text-uppercase">
          Add Ons
        </h3>
        <p
          v-for="(addOn, index) in product.data.add_ons"
          :key="index"
          class="m-0"
        >
          - {{ addOn.name }} -- {{ $currencyFormat(addOn.price) }}
        </p>
      </div>
      <div class="row mt-4">
        <h3 class="border-start border-4 border-primary fw-bold text-uppercase">
          Variants
        </h3>
        <p
          v-for="(variant, index) in product.data.variants"
          :key="index"
          class="m-0"
        >
          - {{ variant.name }} -- {{ $currencyFormat(variant.price) }}
        </p>
      </div>
    </div>
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
