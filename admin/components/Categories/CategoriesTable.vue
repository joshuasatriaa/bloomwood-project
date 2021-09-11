<template>
  <div class="table-responsive">
    <table v-if="categories.data" class="table table-striped table-hover">
      <thead class="">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col" class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(category, index) in categories.data" :key="category.id">
          <td>
            {{ index + 1 }}
          </td>
          <td class="text-nowrap">
            {{ category.name }}
            <span v-if="!category.parent_id" class="badge bg-warning ms-3"
              >Parent</span
            >
          </td>
          <td class="text-end text-nowrap">
            <NuxtLink
              :to="`/categories/${category.id}/edit`"
              class="btn btn-primary"
              >Edit</NuxtLink
            >
            <button
              class="btn btn-danger"
              @click="deleteConfirmation(category.id)"
            >
              Delete
            </button>
          </td>
        </tr>
        <tr v-if="!categories.data.length">
          <td colspan="3" class="text-center">
            <span class="text-danger fw-bold">Data not found.</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { useCategoryForm } from '@/composables/useCategoryForm'

export default {
  name: 'CategoriesTable',
  props: {
    categories: {
      type: Object,
      default: () => {},
    },
  },
  setup() {
    const { deleteCategory } = useCategoryForm()

    const deleteConfirmation = (id) => {
      const conf = confirm('Are you sure you want to delete this category?')
      if (conf) {
        deleteCategory(id)
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
