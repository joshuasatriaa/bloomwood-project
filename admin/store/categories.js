export const state = () => ({
  categories: {},
  category: {},
  qs: '',
  onlyParents: false,
})

export const getters = {
  CATEGORIES(state) {
    return state.categories
  },
  CATEGORY(state) {
    return state.category
  },
  QUERY(state) {
    return state.qs
  },
}

export const mutations = {
  SET_CATEGORIES(state, payload) {
    state.categories = payload
  },
  SET_CATEGORY(state, payload) {
    state.category = payload
  },
  SET_QUERY(state, payload) {
    state.qs = payload
  },
  SET_ONLY_PARENTS(state, payload) {
    state.onlyParents = payload
  },
}

export const actions = {
  async GET_CATEGORIES({ commit, state }, { page = 1 }) {
    let query = ''
    if (state.qs) {
      query = state.qs
    }
    if (state.onlyParents) {
      query += '&only_parents=true'
    }
    const res = await this.$axios.$get(`/api/categories?page=${page}${query}`)
    commit('SET_CATEGORIES', res)
    commit('SET_ONLY_PARENTS', false)
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
    const res = await this.$axios.$post(
      `/api/categories/${id}?_method=PUT`,
      payload
    )
    commit('SET_CATEGORY', res)
    return res
  },
  async DELETE_CATEGORY({ commit }, id) {
    const res = await this.$axios.$delete(`/api/categories/${id}`)
    return res
  },
}
