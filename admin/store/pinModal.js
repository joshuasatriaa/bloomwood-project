export const state = () => ({
  showModal: false,
  pin: '',
})

export const getters = {
  SHOW_MODAL(state) {
    return state.showModal
  },
  PIN(state) {
    return state.pin
  },
}

export const mutations = {
  TOGGLE_SHOW_MODAL(state) {
    state.showModal = !state.showModal
  },
  SET_PIN(state, payload) {
    state.pin = payload
  },
  RESET_PIN(state) {
    state.pin = ''
  },
}

export const actions = {}
