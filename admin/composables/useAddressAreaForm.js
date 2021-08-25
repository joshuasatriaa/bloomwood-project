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

const useAddressAreaForm = () => {
  const { app } = useContext()
  const store = useStore()
  const router = useRouter()
  const route = useRoute()

  const form = reactive({
    small_price: null,
    medium_price: null,
  })

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

  return {
    form,
    updateAddressArea,
  }
}

export { useAddressAreaForm }
