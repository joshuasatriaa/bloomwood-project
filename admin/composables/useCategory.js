import {
  useContext,
  useStore,
  computed,
  onMounted,
  useRoute,
} from '@nuxtjs/composition-api'

const useGetCategory = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getCategory = async () => {
    const [_, err] = await app.$async(
      store.dispatch('categories/GET_CATEGORY', route.value.params.id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Category data fetched.')
  }

  onMounted(async () => {
    await getCategory()
  })

  const category = computed(() => {
    return store.getters['categories/CATEGORY']
  })

  return { category, getCategory }
}

const useGetCategories = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getCategories = async () => {
    const [_, err] = await app.$async(
      store.dispatch('categories/GET_CATEGORIES', {})
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Categories data fetched.')
  }

  onMounted(async () => {
    await getCategories()
  })

  const categories = computed(() => {
    return store.getters['categories/CATEGORIES']
  })

  return { categories, getCategories }
}

export { useGetCategory, useGetCategories }
