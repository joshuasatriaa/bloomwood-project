import {
  useContext,
  useStore,
  computed,
  onMounted,
  onUnmounted,
  useRoute,
} from '@nuxtjs/composition-api'

const useGetNavigationGroup = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getNavigationGroup = async () => {
    const [_, err] = await app.$async(
      store.dispatch(
        'navigationGroups/GET_NAVIGATION_GROUP',
        route.value.params.id
      )
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Group data fetched.')
  }

  onMounted(async () => {
    await getNavigationGroup()
  })

  const navigationGroup = computed(() => {
    return store.getters['navigationGroups/NAVIGATION_GROUP']
  })

  return { navigationGroup, getNavigationGroup }
}

const useGetNavigationGroups = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getNavigationGroups = async () => {
    const [_, err] = await app.$async(
      store.dispatch('navigationGroups/GET_NAVIGATION_GROUPS', {})
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Groups data fetched.')
  }

  onMounted(async () => {
    await getNavigationGroups()
  })

  const navigationGroups = computed(() => {
    return store.getters['navigationGroups/NAVIGATION_GROUPS']
  })

  return { navigationGroups, getNavigationGroups }
}

export { useGetNavigationGroup, useGetNavigationGroups }
