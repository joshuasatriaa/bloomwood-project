<template>
  <div class="container">
    <h1 class="mb-4">Navigation Group List</h1>
    <div class="row">
      <div class="col text-end">
        <NuxtLink
          to="/categories/groups/create"
          class="btn btn-success text-white mb-4"
          >Add New Group</NuxtLink
        >
      </div>
    </div>
    <CategoriesGroupTable
      v-if="navigationGroups"
      :navigation-groups="navigationGroups"
    />
    <hr />
    <h1 class="mb-4 mt-4">Category List</h1>
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
import { useGetNavigationGroups } from '@/composables/useNavigationGroup'
export default {
  middleware: 'auth',
  setup() {
    const { categories, getCategories } = useGetCategories()
    const { navigationGroups, getNavigationGroups } = useGetNavigationGroups()

    return { categories, getCategories, navigationGroups, getNavigationGroups }
  },
}
</script>

<style></style>
