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
        :error="errors.password"
      />
      <InputText
        id="new-password"
        v-model="form.newPassword"
        type="password"
        label="Enter new password"
        class="mb-7"
        :error="errors.new_password"
      />
      <InputText
        id="new-password-confirmation"
        v-model="form.newPasswordConfirmation"
        type="password"
        label="Confirm new password"
        class="mb-7"
        :error="errors.new_password_confirmation"
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
      <p v-if="success" class="text-center text-success font-bold mt-5">
        Password successfully changed
      </p>
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
      errors: {},
      success: false,
    }
  },
  methods: {
    async save() {
      const [_, err] = await this.$async(
        this.$axios.$put('/api/user/change-password', {
          password: this.form.oldPassword,
          new_password: this.form.newPassword,
          new_password_confirmation: this.form.newPasswordConfirmation,
        })
      )
      if (err) {
        if (err.response.status.code === 403) {
          this.errors = { password: ["Old password didn't match"] }
          return
        }
        this.errors = err.response.data.errors
        return
      }

      Object.assign(this.$data, this.$options.data())
      this.success = true
      setTimeout(() => {
        this.success = false
      }, 3000)
    },
  },
}
</script>
<style></style>
