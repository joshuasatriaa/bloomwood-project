import {
  useContext,
  useStore,
  computed,
  onMounted,
  useRoute,
} from '@nuxtjs/composition-api'

const useGetProduct = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getProduct = async () => {
    const [_, err] = await app.$async(
      store.dispatch('products/GET_PRODUCT', route.value.params.id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Product data fetched.')
  }

  onMounted(async () => {
    await getProduct()
  })

  const product = computed(() => {
    return store.getters['products/PRODUCT']
  })

  return { product, getProduct }
}

const useGetProducts = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getProducts = async (search = '') => {
    const qs = app.$qsHandler('search', search)
    store.commit('products/SET_QUERY', qs)
    const [_, err] = await app.$async(
      store.dispatch('products/GET_PRODUCTS', {})
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Products data fetched.')
  }

  onMounted(async () => {
    await getProducts()
  })

  const products = computed(() => {
    return store.getters['products/PRODUCTS']
  })

  return { products, getProducts }
}

export { useGetProduct, useGetProducts }
