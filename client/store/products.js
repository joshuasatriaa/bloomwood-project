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
  async GET_PRODUCTS(
    { commit, state },
    { page = 1, category = null, search = null }
  ) {
    let query = ''
    if (state.qs) {
      query = state.qs
    }
    const res = await this.$axios.$get('/api/products', {
      params: {
        // eslint-disable-next-line no-sequences
        ...(search, { search }),
        // eslint-disable-next-line no-sequences
        ...(page, { page }),
        // eslint-disable-next-line no-sequences
        ...(category, { category }),
      },
    })
    commit('SET_PRODUCTS', res)
    return res
  },
  async GET_PRODUCT({ commit }, id) {
    const res = await this.$axios.$get(`/api/products/${id}`)
    commit('SET_PRODUCT', res)
    return res
  },
}
