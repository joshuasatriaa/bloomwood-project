export const state = () => ({
  testimonies: {},
})

export const getters = {
  TESTIMONIES(state) {
    return state.testimonies
  },
}

export const mutations = {
  SET_TESTIMONIES(state, payload) {
    state.testimonies = payload
  },
}

export const actions = {
  async GET_TESTIMONIES({ commit, state }) {
    const res = await this.$axios.$get(`/api/testimonies`)
    commit('SET_TESTIMONIES', res)
    return res
  },
}
