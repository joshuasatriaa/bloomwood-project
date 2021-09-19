export const state = () => ({
  orderHistory: {},
})

export const getters = {
  ORDER_HISTORY(state) {
    return state.orderHistory
  },
}

export const mutations = {
  SET_ORDER_HISTORY(state, payload) {
    state.orderHistory = payload
  },
}

export const actions = {
  async GET_ORDER_HISTORY({ commit, state }) {
    const res = await this.$axios.$get('/api/invoices')
    commit('SET_ORDER_HISTORY', res)
    return res
  },
}
