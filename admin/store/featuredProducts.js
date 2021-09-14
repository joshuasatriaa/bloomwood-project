export const state = () => ({
  featuredProducts: {},
})

export const getters = {
  FEATURED_PRODUCTS(state) {
    return state.featuredProducts
  },
}

export const mutations = {
  SET_FEATURED_PRODUCTS(state, payload) {
    state.featuredProducts = payload
  },
}

export const actions = {
  async GET_FEATURED_PRODUCTS({ commit, state }) {
    const res = await this.$axios.$get(`/api/featured-products`)
    commit('SET_FEATURED_PRODUCTS', res)
    return res
  },
  async STORE_FEATURED_PRODUCTS({ commit }, ids) {
    const res = await this.$axios.$post(`/api/featured-products`, {
      product_ids: ids,
    })
    commit('SET_FEATURED_PRODUCTS', res)
    return res
  },
}
