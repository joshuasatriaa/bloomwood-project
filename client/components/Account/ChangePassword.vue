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
    <h2 class="text-3xl mb-14 text-primary font-bold">Change Password</h2>
    <form @submit.prevent="save()">
      <InputText
        id="old-password"
        v-model="form.oldPassword"
        type="password"
        label="Enter old password"
        class="mb-7"
      />
      <InputText
        id="new-password"
        v-model="form.newPassword"
        type="password"
        label="Enter new password"
        class="mb-7"
      />
      <InputText
        id="new-password-confirmation"
        v-model="form.newPasswordConfirmation"
        type="password"
        label="Confirm new password"
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
  name: 'AccountChangePassword',
  data() {
    return {
      form: {
        oldPassword: '',
        newPassword: '',
        newPasswordConfirmation: '',
      },
    }
  },
  methods: {
    save() {
      console.log('save')
    },
  },
}
</script>
<style></style>
