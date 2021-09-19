<template>
  <div class="container mx-auto text-primary pt-20">
    <AccountCardContainer
      title="Reset Password"
      description="please enter your email and new password"
    >
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
          label="Enter new password"
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
        <button
          type="submit"
          class="
            w-full
            bg-primary
            font-bold
            text-lg text-white
            py-3
            rounded-md
            mb-10
          "
        >
          submit
        </button>
        <p v-if="success" class="font-bold text-success text-center">
          Your password has been reset. Please login with your new password.
        </p>
      </form>
    </AccountCardContainer>
  </div>
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
      success: false,
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
        return
      }

      this.success = true
      setTimeout(() => {
        this.success = false
        this.$router.push('/accounts/login')
      }, 3000)
    },
  },
}
</script>
<style></style>
