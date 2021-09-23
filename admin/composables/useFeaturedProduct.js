import {
  useContext,
  useStore,
  computed,
  onMounted,
  useRoute,
  reactive,
  watch,
  watchEffect,
} from '@nuxtjs/composition-api'

const useGetFeaturedProducts = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const products = reactive({
    data: [],
  })

  const getFeaturedProducts = async () => {
    const [_, err] = await app.$async(
      store.dispatch('featuredProducts/GET_FEATURED_PRODUCTS')
    )
    if (err) {
      app.$errorHandler(err)
    }
  }

  const featuredProducts = computed(() => {
    return store.getters['featuredProducts/FEATURED_PRODUCTS']
  })

  // watchEffect(
  //   () => featuredProducts,
  //   () => {
  //     initProducts()
  //   }
  // )

  const initProducts = () => {
    products.data = ['test']
  }

  onMounted(async () => {
    await getFeaturedProducts()
    initProducts()
  })

  return { products, featuredProducts, getFeaturedProducts }
}

export { useGetFeaturedProducts }
