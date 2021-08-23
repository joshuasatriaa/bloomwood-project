export const state = () => ({})

export const getters = {}

export const mutations = {}

export const actions = {
  async DELETE_PRODUCT_VARIANT({ commit }, id) {
    const res = await this.$axios.$delete(`/api/product-variants/${id}`)
    return res
  },
}
