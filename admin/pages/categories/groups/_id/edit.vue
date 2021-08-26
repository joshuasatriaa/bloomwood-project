<template>
  <div class="container">
    <h1>Edit Group</h1>
    <CategoriesGroupForm
      v-if="navigationGroup.data"
      :is-update="true"
      :navigation-group="navigationGroup"
    />
  </div>
</template>

<script>
import { useGetNavigationGroup } from '@/composables/useNavigationGroup'
export default {
  middleware: 'auth',
  setup() {
    const { navigationGroup } = useGetNavigationGroup()

    return { navigationGroup }
  },
}
</script>

<style></style>
