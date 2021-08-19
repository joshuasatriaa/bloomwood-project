<template>
  <div
    id="carouselExampleControls"
    class="carousel slide"
    data-bs-ride="carousel"
  >
    <div class="carousel-inner">
      <div
        v-for="(image, index) in productImages"
        :key="image.id"
        class="carousel-item"
        :class="{ active: index === 0 }"
      >
        <img
          :src="image.original_image"
          class="d-block w-100"
          style="object-fit: contain"
          alt="carousel images"
          height="500"
        />
      </div>
    </div>
    <button
      class="carousel-control-prev"
      type="button"
      data-bs-target="#carouselExampleControls"
      data-bs-slide="prev"
    >
      <span
        class="carousel-control-prev-icon rounded-3"
        aria-hidden="true"
      ></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button
      class="carousel-control-next"
      type="button"
      data-bs-target="#carouselExampleControls"
      data-bs-slide="next"
    >
      <span
        class="carousel-control-next-icon rounded-3"
        aria-hidden="true"
      ></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</template>

<script>
export default {
  name: 'ProductsImageCarousel',
  computed: {
    productImages() {
      return this.$store.getters['products/PRODUCT'].data.images
    },
  },
}
</script>

<style></style>
