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
    }
  },
  methods: {
    async forgotPassword() {
      await this.$axios.$get('/sanctum/csrf-cookie')
      await this.$async(this.$axios.$post('/forgot-password', this.form))
    },
  },
}
</script>
<style></style>
