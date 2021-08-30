import {
  useContext,
  useStore,
  computed,
  onMounted,
  onUnmounted,
  useRoute,
  onFetch,
  onServerPrefetch,
  useFetch,
} from '@nuxtjs/composition-api'

const useGetNavigationGroup = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getNavigationGroup = async () => {
    const [_, err] = await app.$async(
      store.dispatch('GET_NAVIGATION_GROUP', route.value.params.id)
    )
  }

  onServerPrefetch(async () => {
    await getNavigationGroup()
  })

  const navigationGroup = computed(() => {
    return store.getters.NAVIGATION_GROUP
  })

  return { navigationGroup, getNavigationGroup }
}

const useGetNavigationGroups = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getNavigationGroups = async () => {
    const [_, err] = await app.$async(
      store.dispatch('GET_NAVIGATION_GROUPS', {})
    )
  }

  // onServerPrefetch(async () => {
  //   await getNavigationGroups()
  // })

  const { fetch, fetchState } = useFetch(async () => {
    await getNavigationGroups()
  })

  const navigationGroups = computed(() => {
    return store.getters.NAVIGATION_GROUPS
  })

  return { navigationGroups, getNavigationGroups }
}

export { useGetNavigationGroup, useGetNavigationGroups }
