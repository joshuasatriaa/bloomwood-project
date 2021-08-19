<template>
  <div class="container">
    <h1>Edit Category</h1>
    <CategoriesForm
      v-if="category.data"
      :is-update="true"
      :category="category"
    />
  </div>
</template>

<script>
import { useGetCategory } from '@/composables/useCategory'
export default {
  middleware: 'auth',
  setup() {
    const { category } = useGetCategory()

    return { category }
  },
}
</script>

<style></style>
