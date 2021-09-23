<template>
  <div class="table-responsive">
    <table v-if="addressAreas.data" class="table table-striped table-hover">
      <thead class="">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Small Price</th>
          <th scope="col">Medium Price</th>
          <th scope="col" class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(addressArea, index) in addressAreas.data"
          :key="addressArea.id"
        >
          <td>
            {{ index + 1 }}
          </td>
          <td class="text-nowrap">{{ addressArea.name }}</td>
          <td class="">{{ addressArea.description }}</td>
          <td class="text-nowrap">
            {{ $currencyFormat(addressArea.small_price) }}
          </td>
          <td class="text-nowrap">
            {{ $currencyFormat(addressArea.medium_price) }}
          </td>
          <td class="text-end text-nowrap">
            <NuxtLink
              :to="`/address-areas/${addressArea.id}/edit`"
              class="btn btn-primary"
              >Edit</NuxtLink
            >
            <button
              class="btn btn-danger"
              @click="deleteConfirmation(addressArea.id)"
            >
              Delete
            </button>
          </td>
        </tr>
        <tr v-if="!addressAreas.data.length">
          <td colspan="7" class="text-center">
            <span class="text-danger fw-bold">Data not found.</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { useAddressAreaForm } from '@/composables/useAddressAreaForm'

export default {
  name: 'AddressAreasTable',
  props: {
    addressAreas: {
      type: Object,
      default: () => {},
    },
  },
  setup() {
    const { deleteAddressArea } = useAddressAreaForm()

    const deleteConfirmation = (id) => {
      const conf = confirm('Are you sure you want to delete this area?')
      if (conf) {
        deleteAddressArea(id)
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
