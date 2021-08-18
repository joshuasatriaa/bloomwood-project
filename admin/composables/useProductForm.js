import {
  useContext,
  useRouter,
  useStore,
  computed,
  onMounted,
  useRoute,
  ref,
  reactive,
} from '@nuxtjs/composition-api'

const useProductForm = () => {
  const { app } = useContext()
  const store = useStore()
  const router = useRouter()
  const route = useRoute()

  const form = reactive({
    name: '',
    description: '',
    category_ids: [],
    images: [],
  })

  const createProduct = async () => {
    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('products/STORE_PRODUCT', payload)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Product data saved.')
    router.push('/products')
  }

  const updateProduct = async () => {
    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('products/UPDATE_PRODUCT', {
        id: route.value.params.id,
        payload,
      })
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Product data updated.')
    router.push('/products')
  }

  return { form, createProduct, updateProduct }
}

export { useProductForm }
