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

const useCategoryForm = () => {
  const { app } = useContext()
  const store = useStore()
  const router = useRouter()
  const route = useRoute()

  const form = reactive({
    name: '',
  })

  const createCategory = async () => {
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

  return {
    form,
    createCategory,
    updateCategory,
    deleteCategory,
  }
}

export { useCategoryForm }
