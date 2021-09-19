<template>
  <form @submit.prevent="onSubmit">
    <InputText
      id="email"
      v-model="form.email"
      type="email"
      label="Enter email"
      class="mb-7"
      :error="errors.email"
    />
    <InputText
      id="password"
      v-model="form.password"
      type="password"
      label="Enter password"
      class="mb-7"
      :error="errors.password"
    />
    <InputText
      id="password-confirmation"
      v-model="form.passwordConfirmation"
      type="password"
      label="Confirm password"
      class="mb-7"
      :error="errors.password_confirmation"
    />
    <button type="submit">submit</button>
  </form>
</template>
<script>
export default {
  data() {
    return {
      form: {
        email: '',
        password: '',
        passwordConfirmation: '',
      },
      errors: {},
    }
  },
  methods: {
    async onSubmit() {
      const [_, err] = await this.$async(
        this.$axios.$post(`/reset-password?token=${this.$route.query.token}`, {
          email: this.form.email,
          password: this.form.password,
          password_confirmation: this.form.passwordConfirmation,
        })
      )
      if (err) {
        this.errors = err.response.data.errors
        // return
      }

      // this.$route.
    },
  },
}
</script>
<style></style>
