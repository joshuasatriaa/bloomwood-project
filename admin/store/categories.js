export const state = () => ({
  categories: {},
  category: {},
})

export const getters = {
  CATEGORIES(state) {
    return state.categories
  },
  CATEGORY(state) {
    return state.category
  },
}

export const mutations = {
  SET_CATEGORIES(state, payload) {
    state.categories = payload
  },
  SET_CATEGORY(state, payload) {
    state.category = payload
  },
}

export const actions = {
  async GET_CATEGORIES({ commit }) {
    const res = await this.$axios.$get(`/api/categories`)
    commit('SET_CATEGORIES', res)
    return res
  },
  async GET_CATEGORY({ commit }, id) {
    const res = await this.$axios.$get(`/api/categories/${id}`)
    commit('SET_CATEGORY', res)
    return res
  },
  async STORE_CATEGORY({ commit }, payload) {
    const res = await this.$axios.$post(`/api/categories`, payload)
    commit('SET_CATEGORY', res)
    return res
  },
  async UPDATE_CATEGORY({ commit }, { id, payload }) {
    const res = await this.$axios.$patch(`/api/categories/${id}`, payload)
    commit('SET_CATEGORY', res)
    return res
  },
}
