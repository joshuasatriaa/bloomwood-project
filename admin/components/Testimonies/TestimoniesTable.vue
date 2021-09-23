<template>
  <div class="table-responsive">
    <table v-if="testimonies.data" class="table table-striped table-hover">
      <thead class="">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Message</th>
          <th scope="col" class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(testimony, index) in testimonies.data" :key="testimony.id">
          <td>
            {{ index + 1 }}
          </td>
          <td>
            {{ testimony.name }}
          </td>
          <td>{{ testimony.message }}</td>
          <td class="text-end text-nowrap">
            <NuxtLink
              :to="`/testimonies/${testimony.id}/edit`"
              class="btn btn-primary"
              >Edit</NuxtLink
            >
            <button
              class="btn btn-danger"
              @click="deleteConfirmation(testimony.id)"
            >
              Delete
            </button>
          </td>
        </tr>
        <tr v-if="!testimonies.data.length">
          <td colspan="4" class="text-center">
            <span class="text-danger fw-bold">Data not found.</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { useTestimonyForm } from '@/composables/useTestimonyForm'

export default {
  name: 'TestimoniesTable',
  props: {
    testimonies: {
      type: Object,
      default: () => {},
    },
  },
  setup() {
    const { deleteTestimony } = useTestimonyForm()

    const deleteConfirmation = (id) => {
      const conf = confirm('Are you sure you want to delete this testimony?')
      if (conf) {
        deleteTestimony(id)
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
