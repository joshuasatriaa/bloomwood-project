<template>
  <div class="table-responsive">
    <table v-if="navigationGroups.data" class="table table-striped table-hover">
      <thead class="">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col" class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(group, index) in navigationGroups.data" :key="group.id">
          <td>
            {{ index + 1 }}
          </td>
          <td class="text-nowrap">{{ group.name }}</td>
          <td class="text-end text-nowrap">
            <NuxtLink
              :to="`/categories/groups/${group.id}/edit`"
              class="btn btn-primary"
              >Edit</NuxtLink
            >
            <button
              class="btn btn-danger"
              @click="deleteConfirmation(group.id)"
            >
              Delete
            </button>
          </td>
        </tr>
        <tr v-if="!navigationGroups.data.length">
          <td colspan="3" class="text-center">
            <span class="text-danger fw-bold">Data not found.</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { useNavigationGroupForm } from '@/composables/useNavigationGroupForm'

export default {
  name: 'CategoriesGroupTable',
  props: {
    navigationGroups: {
      type: Object,
      default: () => {},
    },
  },
  setup() {
    const { deleteNavigationGroup } = useNavigationGroupForm()

    const deleteConfirmation = (id) => {
      const conf = confirm('Are you sure you want to delete this group?')
      if (conf) {
        deleteNavigationGroup(id)
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
