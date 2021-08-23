export const state = () => ({})

export const getters = {}

export const mutations = {}

export const actions = {
  async DELETE_PRODUCT_ADD_ON({ commit }, id) {
    const res = await this.$axios.$delete(`/api/product-add-ons/${id}`)
    return res
  },
}
