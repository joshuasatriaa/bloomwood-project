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

const useAddressAreaForm = () => {
  const { app } = useContext()
  const store = useStore()
  const router = useRouter()
  const route = useRoute()

  const form = reactive({
    name: '',
    description: '',
    small_price: null,
    medium_price: null,
  })

  const createAddressArea = async () => {
    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('addressAreas/STORE_ADDRESS_AREA', payload)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Area data saved.')
    router.push('/address-areas')
  }

  const updateAddressArea = async () => {
    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('addressAreas/UPDATE_ADDRESS_AREA', {
        id: route.value.params.id,
        payload,
      })
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Address area data updated.')
    router.push('/address-areas')
  }

  const deleteAddressArea = async (id) => {
    const [_, err] = await app.$async(
      store.dispatch('addressAreas/DELETE_ADDRESS_AREA', id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Category deleted.')
    store.dispatch('addressAreas/GET_ADDRESS_AREAS', {})
  }

  onUnmounted(() => {
    store.commit('addressAreas/RESET_STATE')
  })

  return {
    form,
    updateAddressArea,
    createAddressArea,
    deleteAddressArea,
  }
}

export { useAddressAreaForm }
