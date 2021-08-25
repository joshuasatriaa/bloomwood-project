<template>
  <div class="container">
    <h1>Edit Address Area</h1>
    <AddressAreasForm
      v-if="addressArea.data"
      :is-update="true"
      :address-area="addressArea"
    />
  </div>
</template>

<script>
import { useGetAddressArea } from '@/composables/useAddressArea'
export default {
  middleware: 'auth',
  setup() {
    const { addressArea } = useGetAddressArea()

    return { addressArea }
  },
}
</script>

<style></style>
