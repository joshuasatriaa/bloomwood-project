<template>
  <div class="container">
    <h1 class="mb-4">Featured Products</h1>
    <div class="p-4 border-start border-5 border-primary bg-white rounded">
      <p class="text-danger fw-bolder mb-0">
        Order 1 - 4 will be put on the first section (4 grid columns), <br />
        5 & 6 will be put on the second section (2 grid columns) at the landing
        page. <br />
        Drag to reorder and click save at the bottom to save changes.
      </p>
    </div>
    <draggable
      v-if="orderProducts.data"
      v-model="orderProducts.data"
      class="mt-4"
      @start="drag = true"
      @end="drag = false"
    >
      <transition-group>
        <div
          v-for="(product, index) in orderProducts.data"
          :key="product.id"
          class="row my-3 align-items-center"
        >
          <div class="col-6 col-md-2">
            <h5 class="row-title">{{ index + 1 }}</h5>
          </div>
          <div class="col-6 col-md-4">
            <img
              :src="product.images[0].thumbnail_image"
              width="100"
              class="me-auto"
            />
          </div>
          <div class="col-6 col-md-4">
            <p class="row-title">{{ product.name }}</p>
          </div>
          <div class="col-6 col-md-2">
            <button
              type="button"
              class="btn btn-success text-white"
              data-bs-toggle="modal"
              data-bs-target="#modalChangeProduct"
              @click="selectedIndex = index"
            >
              Change
            </button>
          </div>
          <hr class="mt-4" />
        </div>
      </transition-group>
    </draggable>
    <button class="btn btn-primary w-100" @click="saveChanges()">
      Save Changes
    </button>
    <div
      id="modalChangeProduct"
      class="modal fade"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="modalChangeProductLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="modalChangeProductLabel" class="modal-title">
              Change Product
            </h5>
            <button
              id="mdlClose"
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="selectedIndex = null"
            ></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <BaseSearch :callback="getProducts" />
                <table v-if="products.data" class="table table-hover">
                  <thead>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Select</th>
                  </thead>
                  <tbody>
                    <tr v-for="product in products.data" :key="product.id">
                      <td>
                        <img
                          :src="product.images[0].thumbnail_image"
                          width="75"
                        />
                      </td>
                      <td>
                        {{ product.name }}
                      </td>
                      <td>
                        <button
                          class="btn btn-success text-white"
                          @click="swapProduct(product)"
                        >
                          Select
                        </button>
                      </td>
                    </tr>
                    <tr v-if="products.data.length == 0">
                      <td colspan="3" class="text-danger text-center">
                        Product not found
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useGetFeaturedProducts } from '@/composables/useFeaturedProduct'
import { useGetProducts } from '@/composables/useProduct'

export default {
  middleware: 'auth',
  setup() {
    const { featuredProducts, getFeaturedProducts } = useGetFeaturedProducts()
    const { products, getProducts } = useGetProducts()
    return {
      products,
      getProducts,
      featuredProducts,
      getFeaturedProducts,
    }
  },
  data() {
    return {
      orderProducts: {
        data: [],
      },
      selectedIndex: null,
    }
  },
  watch: {
    featuredProducts() {
      this.orderProducts.data = [...this.featuredProducts.data]
    },
  },
  methods: {
    async saveChanges() {
      const ids = this.orderProducts.data.map((x) => x.id)
      const [_, err] = await this.$async(
        this.$store.dispatch('featuredProducts/STORE_FEATURED_PRODUCTS', ids)
      )
      if (err) {
        this.$errorHandler(err)
        return
      }

      this.$successHandler('Changes saved.')
    },
    swapProduct(product) {
      this.orderProducts.data.splice(this.selectedIndex, 1, product)
      document.getElementById('mdlClose').click()
    },
  },
}
</script>

<style scoped>
td,
th {
  vertical-align: middle;
}

.row-title {
  width: 7rem;
}
</style>
