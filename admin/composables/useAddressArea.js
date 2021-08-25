import {
  useContext,
  useStore,
  computed,
  onMounted,
  useRoute,
} from '@nuxtjs/composition-api'

const useGetAddressArea = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getAddressArea = async () => {
    const [_, err] = await app.$async(
      store.dispatch('addressAreas/GET_ADDRESS_AREA', route.value.params.id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Address area data fetched.')
  }

  onMounted(async () => {
    await getAddressArea()
  })

  const addressArea = computed(() => {
    return store.getters['addressAreas/ADDRESS_AREA']
  })

  return { addressArea, getAddressArea }
}

const useGetAddressAreas = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getAddressAreas = async (search = '') => {
    const qs = app.$qsHandler('search', search)
    store.commit('addressAreas/SET_QUERY', qs)
    const [_, err] = await app.$async(
      store.dispatch('addressAreas/GET_ADDRESS_AREAS', {})
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Address areas data fetched.')
  }

  onMounted(async () => {
    await getAddressAreas()
  })

  const addressAreas = computed(() => {
    return store.getters['addressAreas/ADDRESS_AREAS']
  })

  return { addressAreas, getAddressAreas }
}

export { useGetAddressArea, useGetAddressAreas }
