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

const useGetProducts = (search = '', group = '') => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getProducts = async (search = '', group = '') => {
    const qsSearch = app.$qsHandler('search', search)
    const qsGroup = app.$qsHandler('group', group)
    store.commit('products/SET_QUERY', `${qsSearch}${qsGroup}`)
    const [_, err] = await app.$async(
      store.dispatch('products/GET_PRODUCTS', {})
    )
  }

  useFetch(async () => {
    await getProducts(search, group)
  })

  const products = computed(() => {
    return store.getters['products/PRODUCTS']
  })

  return { products, getProducts }
}

export { useGetProduct, useGetProducts }
