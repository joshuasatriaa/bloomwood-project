import {
  useContext,
  useStore,
  computed,
  onMounted,
  useRoute,
} from '@nuxtjs/composition-api'

const useGetContactUs = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getContactUs = async () => {
    const [_, err] = await app.$async(
      store.dispatch('contactUs/GET_CONTACT_US', route.value.params.id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Contact us data fetched.')
  }

  onMounted(async () => {
    await getContactUs()
  })

  const contactUs = computed(() => {
    return store.getters['contactUs/CONTACT_US']
  })

  return { contactUs, getContactUs }
}

const useGetContactUss = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getContactUss = async (search = '') => {
    const qs = app.$qsHandler('search', search)
    store.commit('contactUs/SET_QUERY', qs)
    const [_, err] = await app.$async(
      store.dispatch('contactUs/GET_CONTACT_USS', {})
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Contact us data fetched.')
  }

  onMounted(async () => {
    await getContactUss()
  })

  const contactUss = computed(() => {
    return store.getters['contactUs/CONTACT_USS']
  })

  return { contactUss, getContactUss }
}

export { useGetContactUs, useGetContactUss }
