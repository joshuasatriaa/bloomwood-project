export const state = () => ({
  testimonies: {},
  testimony: {},
  qs: '',
})

export const getters = {
  TESTIMONIES(state) {
    return state.testimonies
  },
  TESTIMONY(state) {
    return state.testimony
  },
  QUERY(state) {
    return state.qs
  },
}

export const mutations = {
  SET_TESTIMONIES(state, payload) {
    state.testimonies = payload
  },
  SET_TESTIMONY(state, payload) {
    state.testimony = payload
  },
  SET_QUERY(state, payload) {
    state.qs = payload
  },
  RESET_STATE(state) {
    state.testimony = {}
  },
}

export const actions = {
  async GET_TESTIMONIES({ commit, state }, { page = 1 }) {
    let query = ''
    if (state.qs) {
      query = state.qs
    }
    const res = await this.$axios.$get(`/api/testimonies?page=${page}${query}`)
    commit('SET_TESTIMONIES', res)
    return res
  },
  async GET_TESTIMONY({ commit }, id) {
    const res = await this.$axios.$get(`/api/testimonies/${id}`)
    commit('SET_TESTIMONY', res)
    return res
  },
  async STORE_TESTIMONY({ commit }, payload) {
    const res = await this.$axios.$post(`/api/testimonies`, payload)
    commit('SET_TESTIMONY', res)
    return res
  },
  async UPDATE_TESTIMONY({ commit }, { id, payload }) {
    const res = await this.$axios.$post(
      `/api/testimonies/${id}?_method=PUT`,
      payload
    )
    commit('SET_TESTIMONY', res)
    return res
  },
  async DELETE_TESTIMONY({ commit }, id) {
    const res = await this.$axios.$delete(`/api/testimonies/${id}`)
    return res
  },
}
