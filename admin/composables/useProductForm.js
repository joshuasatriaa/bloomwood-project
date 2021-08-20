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
    variants: [
      {
        name: '',
        thumbnail_image: null,
      },
    ],
  })
  const previewImages = reactive([])
  const previewVariants = reactive([])

  const createProduct = async () => {
    const payload = app.$jsonToFormData(form)
    const [res, err] = await app.$async(
      store.dispatch('products/STORE_PRODUCT', payload)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Product data saved.')
    router.push('/products/' + res.data.id)
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
    router.push('/products/' + route.value.params.id)
  }

  const deleteProductImage = async (id, index) => {
    const [_, err] = await app.$async(
      store.dispatch('productImages/DELETE_PRODUCT_IMAGE', id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Product image deleted.')
    previewImages.splice(index, 1)
  }

  const deleteProduct = async (id) => {
    const [_, err] = await app.$async(
      store.dispatch('products/DELETE_PRODUCT', id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Product deleted.')
    store.dispatch('products/GET_PRODUCTS', {})
  }

  const moreVariant = () => {
    form.variants.push({
      name: '',
      thumbnail_image: null,
    })
  }

  const deleteVariant = (idx) => {
    form.variants.splice(idx, 1)
  }

  const deleteProductVariant = async (id, index) => {
    const [_, err] = await app.$async(
      store.dispatch('productVariants/DELETE_PRODUCT_VARIANT', id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Product variant deleted.')
    previewVariants.splice(index, 1)
  }

  return {
    form,
    previewImages,
    createProduct,
    updateProduct,
    deleteProductImage,
    deleteProduct,
    moreVariant,
    deleteVariant,
    previewVariants,
    deleteProductVariant,
  }
}

export { useProductForm }
