import {
  useContext,
  useStore,
  computed,
  useFetch,
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
  }

  useFetch(async () => {
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
  }

  useFetch(async () => {
    await getAddressAreas()
  })

  const addressAreas = computed(() => {
    return store.getters['addressAreas/ADDRESS_AREAS']
  })

  return { addressAreas, getAddressAreas }
}

export { useGetAddressArea, useGetAddressAreas }
