<template>
  <div class="container">
    <h1 class="mb-4">Category List</h1>
    <div class="row">
      <div class="col text-end">
        <NuxtLink
          to="/categories/create"
          class="btn btn-success text-white mb-4"
          >Add New Category</NuxtLink
        >
      </div>
    </div>
    <BaseSearch :callback="getCategories" />
    <CategoriesTable v-if="categories" :categories="categories" />
    <div class="col-12 col-md-6 d-flex justify-content-end ms-auto">
      <BasePagination
        getter="categories/CATEGORIES"
        action="categories/GET_CATEGORIES"
      />
    </div>
  </div>
</template>

<script>
import { useGetCategories } from '@/composables/useCategory'
export default {
  middleware: 'auth',
  setup() {
    const { categories, getCategories } = useGetCategories()
    return { categories, getCategories }
  },
}
</script>

<style></style>
