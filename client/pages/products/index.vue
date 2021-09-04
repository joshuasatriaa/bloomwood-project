<template>
  <div
    class="container mx-auto pt-20 lg:px-32 text-center font-bold text-primary"
  >
    <div class="mb-8">
      <h1 class="text-3xl md:text-4xl font-normal mb-5 font-serif">
        Bloom Bouquet
      </h1>
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
      <NuxtLink
        v-for="{ id, images, name, price, slug } in products.data"
        :key="id"
        :to="`/products/${slug}/${id}`"
      >
        <ContainedImage
          :src="images[0].original_image"
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
            font-normal font-serif
          "
        >
          {{ name }}
        </h2>
        <p class="text-lg">{{ $currencyFormat(price) }}</p>
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

    const group = computed(() => route.value.query.group)

    const { products, getProducts } = useGetProducts('', group.value)

    watch(
      () => route.value.query.group,
      () => getProducts('', group.value)
    )

    return { products, getProducts }
  },
}
</script>
<style></style>
