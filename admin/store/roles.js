export const state = () => ({
  roles: {},
})

export const getters = {
  ROLES(state) {
    return state.roles
  },
}

export const mutations = {
  SET_ROLES(state, payload) {
    state.roles = payload
  },
}

export const actions = {
  async GET_ROLES({ commit }) {
    const res = await this.$axios.$get(`/api/roles`)
    commit('SET_ROLES', res)
    return res
  },
}
