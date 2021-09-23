import {
  useContext,
  useStore,
  computed,
  onMounted,
  useRoute,
} from '@nuxtjs/composition-api'

const useGetInvoice = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getInvoice = async () => {
    const [_, err] = await app.$async(
      store.dispatch('invoices/GET_INVOICE', route.value.params.id)
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Invoice data fetched.')
  }

  onMounted(async () => {
    await getInvoice()
  })

  const invoice = computed(() => {
    return store.getters['invoices/INVOICE']
  })

  return { invoice, getInvoice }
}

const useGetInvoices = () => {
  const { app } = useContext()
  const store = useStore()
  const route = useRoute()

  const getInvoices = async (search = '') => {
    const qs = app.$qsHandler('search', search)
    store.commit('invoices/SET_QUERY', qs)
    const [_, err] = await app.$async(
      store.dispatch('invoices/GET_INVOICES', {})
    )
    if (err) {
      app.$errorHandler(err)
      return
    }

    app.$successHandler('Invoices data fetched.')
  }

  onMounted(async () => {
    await getInvoices()
  })

  const invoices = computed(() => {
    return store.getters['invoices/INVOICES']
  })

  return { invoices, getInvoices }
}

export { useGetInvoice, useGetInvoices }
