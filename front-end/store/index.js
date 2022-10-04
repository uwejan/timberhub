export const state = () => ({
  products: [],
  notifications:{},
  suppliers: []
})

export const getters = {

}

export const mutations = {
  newNotification(state, { title, body, variant }) {
    state.notifications = {
      title,
      body,
      variant,
    }
  },
  emptyNotification(state) {
    state.notifications = {}
  },
  updateProducts(state, { data }) {
    state.products = data
  },

  updateSuppliers(state, { data }) {
    state.suppliers = data
  },
  addProduct(state, {data}){
    state.products.push(data)
  }
}

export const actions = {
  async nuxtServerInit({ commit }) {
    const URL = '/api/products'
    const URLsuppliers = '/api/suppliers'
    const suppliers = await this.$axios.$get(URLsuppliers)
    const products = await  this.$axios.$get(URL)

    commit('updateSuppliers', { data: suppliers.data })
    commit('updateProducts', { data: products.data })
  },
}
