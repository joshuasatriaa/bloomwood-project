<template>
  <div
    class="container mx-auto pt-20 lg:px-32 text-center font-bold text-primary"
  >
    <div class="mb-20">
      <h1 class="text-3xl md:text-4xl font-normal mb-5 font-serif capitalize">
        {{ $route.query.category.replace(/-/g, ' ') }}
      </h1>
      <div class="border-b-2 border-pink w-20 mx-auto flex-shrink"></div>
    </div>
    <div
      class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-16 gap-y-12"
    >
      <NuxtLink
        v-for="{ id, images, name, slug, sizes } in products.data"
        :key="id"
        :to="`/products/${slug}/${id}`"
        class="motion-safe:hover:animate-pulse"
      >
        <ContainedImage
          :src="images[0].original_image"
          width="398"
          height="499"
          alt=""
          class="mb-5"
        />
        <h2
          class="
            text-xl
            md:text-lg
            lg:text-base
            2xl:text-xl
            mb-3
            line-clamp-1
            font-normal font-serif
          "
        >
          {{ name }}
        </h2>
        <p class="text-lg">{{ $currencyFormat(getMinPrice(sizes)) }}</p>
      </NuxtLink>
    </div>
  </div>
</template>

<script>
import { useRoute, computed, watch } from '@nuxtjs/composition-api'
import { useGetProducts } from '@/composables/useProduct'

export default {
  name: 'Products',
  setup() {
    const route = useRoute()

    const category = computed(() => route.value.query.category)

    const { products, getProducts } = useGetProducts('', category.value)

    watch(
      () => route.value.query.category,
      () => getProducts('', category.value)
    )

    const getMinPrice = (sizes) => {
      const { price } = sizes.reduce((prev, curr) =>
        prev.price < curr.price ? prev : curr
      )
      return price
    }

    return { products, getProducts, getMinPrice }
  },
}
</script>
<style></style>
