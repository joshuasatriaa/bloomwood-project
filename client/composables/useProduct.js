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

const useGetProducts = (search = '', category = '') => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getProducts = async (search = '', category = '') => {
    const qsSearch = app.$qsHandler('search', search)
    const qsCategory = app.$qsHandler('category', category)
    store.commit('products/SET_QUERY', `${qsSearch}${qsCategory}`)
    const [_, err] = await app.$async(
      store.dispatch('products/GET_PRODUCTS', {})
    )
  }

  useFetch(async () => {
    await getProducts(search, category)
  })

  const products = computed(() => {
    return store.getters['products/PRODUCTS']
  })

  return { products, getProducts }
}

export { useGetProduct, useGetProducts }
