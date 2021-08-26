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

const useNavigationGroupForm = () => {
  const { app } = useContext()
  const store = useStore()
  const router = useRouter()
  const route = useRoute()

  const form = reactive({
    name: '',
    category_ids: [],
  })

  const createNavigationGroup = async () => {
    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('navigationGroups/STORE_NAVIGATION_GROUP', payload)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Group data saved.')
    router.push('/categories')
  }

  const updateNavigationGroup = async () => {
    const payload = app.$jsonToFormData(form)
    const [_, err] = await app.$async(
      store.dispatch('navigationGroups/UPDATE_NAVIGATION_GROUP', {
        id: route.value.params.id,
        payload,
      })
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Group data updated.')
    router.push('/categories')
  }

  const deleteNavigationGroup = async (id) => {
    const [_, err] = await app.$async(
      store.dispatch('navigationGroups/DELETE_NAVIGATION_GROUP', id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Group deleted.')
    store.dispatch('navigationGroups/GET_NAVIGATION_GROUPS', {})
  }

  onUnmounted(() => {
    store.commit('navigationGroups/RESET_STATE')
  })

  return {
    form,
    createNavigationGroup,
    updateNavigationGroup,
    deleteNavigationGroup,
  }
}

export { useNavigationGroupForm }
