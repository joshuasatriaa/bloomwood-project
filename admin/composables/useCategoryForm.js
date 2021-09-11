import {
  useContext,
  useRouter,
  useStore,
  computed,
  onMounted,
  onUnmounted,
  useRoute,
  ref,
  reactive,
} from '@nuxtjs/composition-api'

const useCategoryForm = () => {
  const { app } = useContext()
  const store = useStore()
  const router = useRouter()
  const route = useRoute()

  const form = reactive({
    name: '',
    parent_id: null,
    thumbnail_image: null,
    isParent: false,
  })

  const createCategory = async () => {
    form.thumbnail_image = form.thumbnail_image[0]

    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('categories/STORE_CATEGORY', payload)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Category data saved.')
    router.push('/categories')
  }

  const updateCategory = async () => {
    form.thumbnail_image = form.thumbnail_image[0]

    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('categories/UPDATE_CATEGORY', {
        id: route.value.params.id,
        payload,
      })
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Category data updated.')
    router.push('/categories')
  }

  const deleteCategory = async (id) => {
    const [_, err] = await app.$async(
      store.dispatch('categories/DELETE_CATEGORY', id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Category deleted.')
    store.dispatch('categories/GET_CATEGORIES', {})
  }

  onUnmounted(() => {
    store.commit('categories/RESET_STATE')
  })

  return {
    form,
    createCategory,
    updateCategory,
    deleteCategory,
  }
}

export { useCategoryForm }
