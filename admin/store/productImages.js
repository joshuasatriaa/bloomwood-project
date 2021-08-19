export const state = () => ({})

export const getters = {}

export const mutations = {}

export const actions = {
  async DELETE_PRODUCT_IMAGE({ commit }, id) {
    const res = await this.$axios.$delete(`/api/product-images/${id}`)
    return res
  },
}
