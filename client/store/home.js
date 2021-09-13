export const state = () => ({
  testimonies: {},
  mostGiftedProducts: {},
})

export const getters = {
  TESTIMONIES(state) {
    return state.testimonies
  },
  MOST_GIFTED_PRODUCTS(state) {
    return state.mostGiftedProducts
  },
}

export const mutations = {
  SET_TESTIMONIES(state, payload) {
    state.testimonies = payload
  },
  SET_MOST_GIFTED_PRODUCTS(state, payload) {
    state.mostGiftedProducts = payload
  },
}

export const actions = {
  async GET_TESTIMONIES({ commit, state }) {
    const res = await this.$axios.$get(`/api/testimonies`)
    commit('SET_TESTIMONIES', res)
    return res
  },
  async GET_MOST_GIFTED_PRODUCTS({ commit, state }) {
    const res = await this.$axios.$get(`/api/most-gifted-products`)
    commit('SET_MOST_GIFTED_PRODUCTS', res)
    return res
  },
}
