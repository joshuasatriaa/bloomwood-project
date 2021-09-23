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
}

export const actions = {
  async GET_ADDRESS_AREAS({ commit, state }) {
    const res = await this.$axios.$get('/api/address-areas')
    commit('SET_ADDRESS_AREAS', res)
    return res
  },
  // async GET_ADDRESS_AREA({ commit }, id) {
  //   const res = await this.$axios.$get(`/api/address-areas/${id}`)
  //   commit('SET_ADDRESS_AREA', res)
  //   return res
  // },
}
