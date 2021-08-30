export const state = () => ({
  invoices: {},
  invoice: {},
  qs: '',
})

export const getters = {
  INVOICES(state) {
    return state.invoices
  },
  INVOICE(state) {
    return state.invoice
  },
  QUERY(state) {
    return state.qs
  },
}

export const mutations = {
  SET_INVOICES(state, payload) {
    state.invoices = payload
  },
  SET_INVOICE(state, payload) {
    state.invoice = payload
  },
  SET_QUERY(state, payload) {
    state.qs = payload
  },
}

export const actions = {
  async GET_INVOICES({ commit, state }, { page = 1 }) {
    let query = ''
    if (state.qs) {
      query = state.qs
    }
    const res = await this.$axios.$get(`/api/invoices?page=${page}${query}`)
    commit('SET_INVOICES', res)
    return res
  },
  async GET_INVOICE({ commit }, id) {
    const res = await this.$axios.$get(`/api/invoices/${id}`)
    commit('SET_INVOICE', res)
    return res
  },
  async STORE_INVOICE({ commit }, payload) {
    const res = await this.$axios.$post(`/api/invoices`, payload)
    commit('SET_INVOICE', res)
    return res
  },
  async UPDATE_INVOICE({ commit }, { id, payload }) {
    const res = await this.$axios.$post(
      `/api/invoices/${id}?_method=PUT`,
      payload
    )
    commit('SET_INVOICE', res)
    return res
  },
  async DELETE_INVOICE({ commit }, id) {
    const res = await this.$axios.$delete(`/api/invoices/${id}`)
    return res
  },
}
