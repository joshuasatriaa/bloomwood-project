<template>
  <div
    class="container mx-auto pt-20 lg:px-32 text-center font-bold text-primary"
  >
    <div class="mb-20">
      <h1 class="text-3xl md:text-4xl font-normal mb-5 font-serif capitalize">
        {{
          !$route.query.search
            ? $route.query.category.replace(/-/g, ' ')
            : `Search Result for "${$route.query.search}"`
        }}
      </h1>
      <div class="border-b-2 border-pink w-20 mx-auto flex-shrink"></div>
    </div>
    <div
      class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-16 gap-y-12"
    >
      <NuxtLink
        v-for="{ id, images, name, slug, sizes } in PRODUCTS.data"
        :key="id"
        :to="`/products/${slug}/${id}`"
        class="group"
      >
        <div>
          <!-- <ContainedImage
            :src="images[0].original_image"
            width="398"
            height="499"
            alt=""
            class="
              mb-5
              transition
              scale-95
              filter
              group-hover:scale-100 group-hover:drop-shadow-xl
            "
          /> -->
          <ContainedImage
            :src="images[0].original_image"
            width="398"
            height="499"
            alt=""
            class="
              mb-5
              transition
              scale-95
              filter
              group-hover:scale-100 group-hover:drop-shadow-xl
            "
            aspect-class="aspect-w-398 aspect-h-499"
          />
        </div>
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
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Products',
  // setup() {
  //   const route = useRoute()

  //   const category = computed(() => route.value.query.category)

  //   const { products, getProducts } = useGetProducts('', category.value)

  //   watch(
  //     () => route.value.query.category,
  //     () => getProducts('', category.value)
  //   )

  //   return { products, getProducts, getMinPrice }
  // },
  data() {
    return { newQuery: this.$route.query }
  },
  async fetch() {
    await this.GET_PRODUCTS({ ...this.newQuery })
  },
  computed: {
    ...mapGetters({
      PRODUCTS: 'products/PRODUCTS',
    }),
  },
  watchQuery(newQuery, oldQuery) {
    const keys1 = Object.keys(oldQuery)
    const keys2 = Object.keys(newQuery)
    if (keys1.length !== keys2.length) {
      this.newQuery = { ...newQuery }
      this.$fetch()
      return true
    }
    for (const key of keys1) {
      if (oldQuery[key] !== newQuery[key]) {
        this.newQuery = { ...newQuery }
        this.$fetch()
        return true
      }
    }
    return false
  },
  methods: {
    ...mapActions({
      GET_PRODUCTS: 'products/GET_PRODUCTS',
    }),
    getMinPrice(sizes) {
      const { price } = sizes.reduce((prev, curr) =>
        prev.price < curr.price ? prev : curr
      )
      return price
    },
  },
}
</script>
<style></style>
