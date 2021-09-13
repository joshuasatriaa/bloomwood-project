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

const useTestimonyForm = () => {
  const { app } = useContext()
  const store = useStore()
  const router = useRouter()
  const route = useRoute()

  const form = reactive({
    name: '',
    message: '',
  })

  const createTestimony = async () => {
    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('testimonies/STORE_TESTIMONY', payload)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Testimony data saved.')
    router.push('/testimonies')
  }

  const updateTestimony = async () => {
    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('testimonies/UPDATE_TESTIMONY', {
        id: route.value.params.id,
        payload,
      })
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Testimony data updated.')
    router.push('/testimonies')
  }

  const deleteTestimony = async (id) => {
    const [_, err] = await app.$async(
      store.dispatch('testimonies/DELETE_TESTIMONY', id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Testimony deleted.')
    store.dispatch('testimonies/GET_TESTIMONIES', {})
  }

  onUnmounted(() => {
    store.commit('testimonies/RESET_STATE')
  })

  return {
    form,
    createTestimony,
    updateTestimony,
    deleteTestimony,
  }
}

export { useTestimonyForm }
