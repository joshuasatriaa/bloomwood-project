import {
  useContext,
  useStore,
  computed,
  useRoute,
  useFetch,
} from '@nuxtjs/composition-api'

const useGetProduct = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getProduct = async () => {
    const [_, err] = await app.$async(
      store.dispatch('products/GET_PRODUCT', route.value.params.id)
    )
  }

  useFetch(async () => {
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
  }

  useFetch(async () => {
    await getProducts()
  })

  const products = computed(() => {
    return store.getters['products/PRODUCTS']
  })

  return { products, getProducts }
}

export { useGetProduct, useGetProducts }
