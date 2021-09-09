<template>
  <div class="bg-tertiary rounded-xl py-14 pl-14 pr-28 w-9/12">
    <h2 class="text-3xl mb-14 text-primary font-bold">
      My Account Information
    </h2>
    <form @submit.prevent="save()">
      <InputText
        id="full-name"
        v-model="form.fullName"
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
        v-model="form.addess"
        type="text"
        label="Address"
        class="mb-7"
      />
      <InputText
        id="area"
        v-model="form.area"
        type="text"
        label="Area"
        class="mb-7"
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
  </div>
</template>
<script>
export default {
  //   props: {
  //     userInfo: {
  //       type: Object,
  //       required: true,
  //     },
  //   },
  name: 'AccountInfo',
  data() {
    return {
      form: {
        email: this.$auth.user.email,
        fullName: this.$auth.user.name,
        phoneNumber: this.$auth.user.phone_number,
        address: this.$auth.user.addresses[0],
        area: '',
      },
    }
  },
  methods: {
    saved() {
      console.log('saved')
    },
  },
}
</script>
<style></style>
