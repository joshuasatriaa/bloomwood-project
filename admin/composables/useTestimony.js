import {
  useContext,
  useStore,
  computed,
  onMounted,
  onUnmounted,
  useRoute,
} from '@nuxtjs/composition-api'

const useGetTestimony = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getTestimony = async () => {
    const [_, err] = await app.$async(
      store.dispatch('testimonies/GET_TESTIMONY', route.value.params.id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Testimony data fetched.')
  }

  onMounted(async () => {
    await getTestimony()
  })

  const testimony = computed(() => {
    return store.getters['testimonies/TESTIMONY']
  })

  return { testimony, getTestimony }
}

const useGetTestimonies = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getTestimonies = async () => {
    const [_, err] = await app.$async(
      store.dispatch('testimonies/GET_TESTIMONIES', {})
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Testimonies data fetched.')
  }

  onMounted(async () => {
    await getTestimonies()
  })

  const testimonies = computed(() => {
    return store.getters['testimonies/TESTIMONIES']
  })

  return { testimonies, getTestimonies }
}

export { useGetTestimony, useGetTestimonies }
