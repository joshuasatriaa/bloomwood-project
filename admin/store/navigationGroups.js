export const state = () => ({
  navigationGroups: {},
  navigationGroup: {},
})

export const getters = {
  NAVIGATION_GROUPS(state) {
    return state.navigationGroups
  },
  NAVIGATION_GROUP(state) {
    return state.navigationGroup
  },
}

export const mutations = {
  SET_NAVIGATION_GROUPS(state, payload) {
    state.navigationGroups = payload
  },
  SET_NAVIGATION_GROUP(state, payload) {
    state.navigationGroup = payload
  },
  RESET_STATE(state) {
    state.navigationGroup = {}
  },
}

export const actions = {
  async GET_NAVIGATION_GROUPS({ commit }, { page = 1 }) {
    const res = await this.$axios.$get(`/api/navigation-groups?page=${page}`)
    commit('SET_NAVIGATION_GROUPS', res)
    return res
  },
  async GET_NAVIGATION_GROUP({ commit }, id) {
    const res = await this.$axios.$get(`/api/navigation-groups/${id}`)
    commit('SET_NAVIGATION_GROUP', res)
    return res
  },
  async STORE_NAVIGATION_GROUP({ commit }, payload) {
    const res = await this.$axios.$post(`/api/navigation-groups`, payload)
    commit('SET_NAVIGATION_GROUP', res)
    return res
  },
  async UPDATE_NAVIGATION_GROUP({ commit }, { id, payload }) {
    const res = await this.$axios.$post(
      `/api/navigation-groups/${id}?_method=PUT`,
      payload
    )
    commit('SET_NAVIGATION_GROUP', res)
    return res
  },
  async DELETE_NAVIGATION_GROUP({ commit }, id) {
    const res = await this.$axios.$delete(`/api/navigation-groups/${id}`)
    return res
  },
}
