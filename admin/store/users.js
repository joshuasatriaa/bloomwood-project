export const state = () => ({
  users: {},
  user: {},
  qs: '',
})

export const getters = {
  USERS(state) {
    return state.users
  },
  USER(state) {
    return state.user
  },
  QUERY(state) {
    return state.qs
  },
}

export const mutations = {
  SET_USERS(state, payload) {
    state.users = payload
  },
  SET_USER(state, payload) {
    state.user = payload
  },
  SET_QUERY(state, payload) {
    state.qs = payload
  },
}

export const actions = {
  async GET_USERS({ commit, state }, { page = 1 }) {
    let query = ''
    if (state.qs) {
      query = state.qs
    }
    const res = await this.$axios.$get(`/api/users?page=${page}${query}`)
    commit('SET_USERS', res)
    return res
  },
  async GET_USER({ commit }, id) {
    const res = await this.$axios.$get(`/api/users/${id}`)
    commit('SET_USER', res)
    return res
  },
  async STORE_USER({ commit }, payload) {
    const res = await this.$axios.$post(`/api/users`, payload)
    commit('SET_USER', res)
    return res
  },
  async UPDATE_USER({ commit }, { id, payload }) {
    const res = await this.$axios.$patch(`/api/users/${id}`, payload)
    commit('SET_USER', res)
    return res
  },
}
