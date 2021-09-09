export const state = () => ({
  loading: false,
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
}

export const mutations = {
  SET_USER_LOGGED_IN(state) {
    state.auth.loggedIn = true
  },
  SET_LOADING(state, bool) {
    state.loading = bool
  },
  LOG_OUT_USER(state) {
    state.auth.loggedIn = false
    state.auth = null
  },
}

export const actions = {
  TOGGLE_LOADING({ commit }, bool = true) {
    commit('SET_LOADING', bool)
  },
}
