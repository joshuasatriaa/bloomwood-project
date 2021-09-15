export const state = () => ({
  addressAreas: {},
  addressArea: {},
  qs: '',
})

export const getters = {
  ADDRESS_AREAS(state) {
    return state.addressAreas
  },
  ADDRESS_AREA(state) {
    return state.addressArea
  },
  QUERY(state) {
    return state.qs
  },
}

export const mutations = {
  SET_ADDRESS_AREAS(state, payload) {
    state.addressAreas = payload
  },
  SET_ADDRESS_AREA(state, payload) {
    state.addressArea = payload
  },
  SET_QUERY(state, payload) {
    state.qs = payload
  },
  RESET_STATE(state) {
    state.addressArea = {}
  },
}

export const actions = {
  async GET_ADDRESS_AREAS({ commit, state }, { page = 1 }) {
    let query = ''
    if (state.qs) {
      query = state.qs
    }
    const res = await this.$axios.$get(
      `/api/address-areas?page=${page}${query}`
    )
    commit('SET_ADDRESS_AREAS', res)
    return res
  },
  async GET_ADDRESS_AREA({ commit }, id) {
    const res = await this.$axios.$get(`/api/address-areas/${id}`)
    commit('SET_ADDRESS_AREA', res)
    return res
  },
  async STORE_ADDRESS_AREA({ commit }, payload) {
    const res = await this.$axios.$post(`/api/address-areas`, payload)
    commit('SET_ADDRESS_AREA', res)
    return res
  },
  async UPDATE_ADDRESS_AREA({ commit }, { id, payload }) {
    const res = await this.$axios.$post(
      `/api/address-areas/${id}?_method=PUT`,
      payload
    )
    commit('SET_ADDRESS_AREA', res)
    return res
  },
  async DELETE_ADDRESS_AREA({ commit }, id) {
    const res = await this.$axios.$delete(`/api/address-areas/${id}`)
    return res
  },
}
