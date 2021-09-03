<template>
  <div
    class="container mx-auto pt-20 lg:px-32 text-center font-bold text-primary"
  >
    <div class="mb-8">
      <h1 class="text-3xl md:text-4xl font-normal mb-5">Bloom Bouquet</h1>
      <div class="border-b-2 border-pink w-20 mx-auto flex-shrink"></div>
    </div>
    <p class="text-lg md:text-xl mb-20">
      'Oh so fresh, pretty and magical' that is how we want every customer who
      received our arrangement to feel. Each and every bouquet is personally
      arranged by our talented florists to ensure top quality and exclusiveness.
    </p>
    <div
      class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-16 gap-y-12"
    >
      <div v-for="(flower, idx) in 6" :key="idx">
        <ContainedImage
          src="/flower-3.jpg"
          width="351"
          height="499"
          alt=""
          class="rounded-lg mb-5"
        />
        <h2
          class="
            text-xl
            md:text-lg
            lg:text-base
            2xl:text-xl
            mb-3
            line-clamp-1
            font-normal
          "
        >
          Hidden Gem in Soft Pink
        </h2>
        <p class="text-lg">{{ $currencyFormat(1950000) }}</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Products',
  data() {
    return {
      res: {},
    }
  },
  async fetch() {
    const res = await this.$axios.$get(
      `/api/products?group=${this.$route.query?.group || ''}`
    )
    this.res = res
  },
}
</script>
<style></style>
