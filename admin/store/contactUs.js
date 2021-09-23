export const state = () => ({
  contactUss: {},
  contactUs: {},
  qs: '',
})

export const getters = {
  CONTACT_USS(state) {
    return state.contactUss
  },
  CONTACT_US(state) {
    return state.contactUs
  },
  QUERY(state) {
    return state.qs
  },
}

export const mutations = {
  SET_CONTACT_USS(state, payload) {
    state.contactUss = payload
  },
  SET_CONTACT_US(state, payload) {
    state.contactUs = payload
  },
  SET_QUERY(state, payload) {
    state.qs = payload
  },
}

export const actions = {
  async GET_CONTACT_USS({ commit, state }, { page = 1 }) {
    let query = ''
    if (state.qs) {
      query = state.qs
    }
    const res = await this.$axios.$get(`/api/contact-us?page=${page}${query}`)
    commit('SET_CONTACT_USS', res)
    return res
  },
  async GET_CONTACT_US({ commit }, id) {
    const res = await this.$axios.$get(`/api/contact-us/${id}`)
    commit('SET_CONTACT_US', res)
    return res
  },
}
