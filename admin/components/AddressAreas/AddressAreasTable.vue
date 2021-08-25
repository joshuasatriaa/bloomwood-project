<template>
  <div class="table-responsive">
    <table v-if="addressAreas.data" class="table table-striped table-hover">
      <thead class="">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Province</th>
          <th scope="col">City</th>
          <th scope="col">District</th>
          <th scope="col">Urban</th>
          <th scope="col">Postal Code</th>
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
          <td class="text-nowrap">{{ addressArea.province }}</td>
          <td class="text-nowrap">{{ addressArea.city }}</td>
          <td class="text-nowrap">{{ addressArea.district }}</td>
          <td class="text-nowrap">{{ addressArea.urban }}</td>
          <td class="text-nowrap">{{ addressArea.postal_code }}</td>
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
export default {
  name: 'AddressAreasTable',
  props: {
    addressAreas: {
      type: Object,
      default: () => {},
    },
  },
}
</script>

<style scoped>
th,
td {
  vertical-align: baseline !important;
}
</style>
