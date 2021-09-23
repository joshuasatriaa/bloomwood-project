<template>
  <div class="container">
    <h1 class="mb-4">Address Areas</h1>
    <div class="row">
      <div class="col text-end">
        <NuxtLink
          to="/address-areas/create"
          class="btn btn-success text-white mb-4"
          >Add New Area</NuxtLink
        >
      </div>
    </div>
    <BaseSearch :callback="getAddressAreas" />
    <AddressAreasTable v-if="addressAreas" :address-areas="addressAreas" />
    <div class="col-12 col-md-6 d-flex justify-content-end ms-auto">
      <BasePagination
        getter="addressAreas/ADDRESS_AREAS"
        action="addressAreas/GET_ADDRESS_AREAS"
      />
    </div>
  </div>
</template>

<script>
import { useGetAddressAreas } from '@/composables/useAddressArea'
export default {
  middleware: 'auth',
  setup() {
    const { addressAreas, getAddressAreas } = useGetAddressAreas()
    return { addressAreas, getAddressAreas }
  },
}
</script>

<style></style>
