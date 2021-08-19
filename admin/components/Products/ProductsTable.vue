<template>
  <div class="table-responsive">
    <table v-if="products.data" class="table table-striped table-hover">
      <thead class="">
        <tr>
          <th scope="col">#</th>
          <th scope="col"></th>
          <th scope="col">Name</th>
          <th scope="col">By</th>
          <th scope="col" class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product, index) in products.data" :key="product.id">
          <td>
            {{ index + 1 }}
          </td>
          <td>
            <img
              v-if="product.images.length > 0"
              :src="product.images[0].thumbnail_image"
              alt=""
              height="50"
            />
            <p v-else class="text-danger">no image</p>
          </td>
          <td class="text-nowrap">{{ product.name }}</td>
          <td>{{ product.user.name }}</td>
          <td class="text-end text-nowrap">
            <NuxtLink :to="`/products/${product.id}`" class="btn btn-primary"
              >Details</NuxtLink
            >
            <button
              class="btn btn-danger"
              @click="deleteConfirmation(product.id)"
            >
              Delete
            </button>
          </td>
        </tr>
        <tr v-if="!products.data.length">
          <td colspan="4" class="text-center">
            <span class="text-danger fw-bold">Data not found.</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { useProductForm } from '@/composables/useProductForm'

export default {
  name: 'ProductsTable',
  props: {
    products: {
      type: Object,
      default: () => {},
    },
  },
  setup() {
    const { deleteProduct } = useProductForm()

    const deleteConfirmation = (id) => {
      const conf = confirm('Are you sure you want to delete this product?')
      if (conf) {
        deleteProduct(id)
      }
    }

    return { deleteConfirmation }
  },
}
</script>

<style scoped>
th,
td {
  vertical-align: baseline !important;
}
</style>
