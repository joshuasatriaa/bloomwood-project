<template>
  <div class="container mx-auto text-primary pt-20">
    <AccountCardContainer
      title="Forgot Password"
      description="please enter your email"
    >
      <form class="flex flex-col" @submit.prevent="forgotPassword()">
        <InputText
          id="email"
          v-model="form.email"
          label="Email Address"
          type="email"
          class="mb-7"
          :error="errors.email"
        />
        <button
          type="submit"
          class="
            w-full
            bg-secondary
            font-bold
            text-xl text-white
            py-3
            rounded-md
            mb-10
          "
        >
          submit
        </button>
        <p v-if="success" class="text-center text-success font-bold mt-5">
          Password reset request has been sent to your email
        </p>
      </form>
    </AccountCardContainer>
  </div>
</template>
<script>
export default {
  name: 'ForgotPassword',
  middleware: 'auth',
  auth: 'guest',
  data() {
    return {
      form: {
        email: '',
      },
      errors: {},
      success: false,
    }
  },
  methods: {
    async forgotPassword() {
      await this.$axios.$get('/sanctum/csrf-cookie')
      const [_, err] = await this.$async(
        this.$axios.$post('/forgot-password', this.form)
      )
      if (err) {
        this.errors = err.response.data.errors
        return
      }

      this.success = true
    },
  },
}
</script>
<style></style>
