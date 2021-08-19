export const state = () => ({
  products: {},
  product: {},
  qs: '',
})

export const getters = {
  PRODUCTS(state) {
    return state.products
  },
  PRODUCT(state) {
    return state.product
  },
  QUERY(state) {
    return state.qs
  },
}

export const mutations = {
  SET_PRODUCTS(state, payload) {
    state.products = payload
  },
  SET_PRODUCT(state, payload) {
    state.product = payload
  },
  SET_QUERY(state, payload) {
    state.qs = payload
  },
}

export const actions = {
  async GET_PRODUCTS({ commit, state }, { page = 1 }) {
    let query = ''
    if (state.qs) {
      query = state.qs
    }
    const res = await this.$axios.$get(`/api/products?page=${page}${query}`)
    commit('SET_PRODUCTS', res)
    return res
  },
  async GET_PRODUCT({ commit }, id) {
    const res = await this.$axios.$get(`/api/products/${id}`)
    commit('SET_PRODUCT', res)
    return res
  },
  async STORE_PRODUCT({ commit }, payload) {
    const res = await this.$axios.$post(`/api/products`, payload)
    commit('SET_PRODUCT', res)
    return res
  },
  async UPDATE_PRODUCT({ commit }, { id, payload }) {
    const res = await this.$axios.$post(
      `/api/products/${id}?_method=PUT`,
      payload
    )
    commit('SET_PRODUCT', res)
    return res
  },
  async DELETE_PRODUCT({ commit }, id) {
    const res = await this.$axios.$delete(`/api/products/${id}`)
    return res
  },
}
