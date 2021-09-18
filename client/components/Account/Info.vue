<template>
  <div
    class="
      bg-tertiary
      rounded-xl
      px-5
      py-10
      sm:py-14 sm:pl-14 sm:pr-28
      w-full
      xl:w-9/12
    "
  >
    <h2 class="text-3xl mb-14 text-primary font-bold">
      My Account Information
    </h2>
    <template v-if="!$fetchState.pending || $auth.user">
      <form @submit.prevent="save()">
        <InputText
          id="full-name"
          v-model="form.name"
          type="text"
          label="Full Name"
          class="mb-7"
        />
        <InputText
          id="email"
          v-model="form.email"
          type="email"
          label="E-mail Address"
          class="mb-7"
        />
        <InputText
          id="phone-number"
          v-model="form.phoneNumber"
          type="tel"
          pattern="^\d{3}-\d{3}-\d{4}$"
          label="Phone Number"
          class="mb-7"
        />
        <InputText
          id="address"
          v-model="form.address"
          type="text"
          label="Address"
          class="mb-7"
        />
        <InputSelect
          id="area"
          v-model="form.area"
          :options="areas"
          label="select area"
          class="mb-7"
          :error="errors.address_area_id"
        />
        <button
          type="submit"
          class="
            w-full
            bg-primary
            font-bold
            text-lg text-white
            py-3
            rounded-md
            max-w-sm
          "
        >
          save changes
        </button>
      </form>
    </template>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'AccountInfo',
  data() {
    return {
      form: {
        email: this.$auth.user.email,
        name: this.$auth.user.name,
        phoneNumber: this.$auth.user.phone_number,
        address: this.$auth.user.addresses[0].address,
        area: this.$auth.user.addresses[0].address_area_id,
      },
      areas: [],
      errors: {},
    }
  },
  async fetch() {
    const res = await this.GET_ADDRESS_AREAS()
    this.areas = res.data.map((address) => {
      return {
        id: address.id,
        label: address.name,
        value: address.id,
      }
    })
  },
  computed: {
    ...mapGetters({
      ADDRESS_AREA: 'addressAreas/ADDRESS_AREA',
    }),
  },
  methods: {
    ...mapActions({
      GET_ADDRESS_AREAS: 'addressAreas/GET_ADDRESS_AREAS',
    }),
    saved() {
      console.log('saved')
    },
  },
}
</script>
<style></style>
