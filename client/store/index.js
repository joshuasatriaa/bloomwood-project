export const state = () => ({
  loading: false,
  navigationGroups: {},
  cartCount: 0,
})

export const getters = {
  isAuthenticated(state) {
    return state.auth.loggedIn
  },
  isLoading(state) {
    return state.loading
  },
  loggedInUser(state) {
    return state.auth.user
  },
  NAVIGATION_GROUPS(state) {
    return state.navigationGroups
  },
  CART_COUNT(state) {
    return state.cartCount
  },
}

export const mutations = {
  SET_USER_LOGGED_IN(state) {
    state.auth.loggedIn = true
  },
  SET_LOADING(state, bool) {
    state.loading = bool
  },
  SET_NAVIGATION_GROUPS(state, payload) {
    state.navigationGroups = payload
  },
  SET_CART_COUNT(state, payload) {
    state.cartCount = payload
  },
}

export const actions = {
  TOGGLE_LOADING({ commit }, bool = true) {
    commit('SET_LOADING', bool)
  },
  async GET_NAVIGATION_GROUPS({ commit }, { page = 1 }) {
    const res = await this.$axios.$get(`/api/navigation-groups?page=${page}`)
    commit('SET_NAVIGATION_GROUPS', res)
    return res
  },
  GET_CART_COUNT({ commit }) {
    const count = Object.keys(this.$getStorage('bloomwoodCart') || {}).length
    commit('SET_CART_COUNT', count)
    return count
  },
}
