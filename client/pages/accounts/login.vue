<template>
  <div class="container mx-auto text-primary pt-20">
    <AccountCardContainer
      title="Welcome Back"
      description="login to your account"
    >
      <form class="flex flex-col" @submit.prevent="submit()">
        <InputText
          id="email"
          v-model="form.email"
          label="Email Address"
          type="email"
          class="mb-7"
          border-color="light"
        />
        <InputText
          id="password"
          v-model="form.password"
          label="Password"
          type="password"
          border-color="light"
        />
        <NuxtLink
          to="/accounts/forgot-password"
          class="font-bold self-end mb-6 hover:text-brown"
          >forgot password ?</NuxtLink
        >
        <button
          type="submit"
          class="
            w-full
            bg-secondary
            font-bold
            text-lg text-white
            py-3
            rounded-md
            mb-10
          "
        >
          login
        </button>
        <p class="font-bold text-center text-secondary">
          don't have an account ?
          <NuxtLink to="/accounts/register" class="text-primary"
            >sign up</NuxtLink
          >
        </p>
      </form>
    </AccountCardContainer>
  </div>
</template>

<script>
export default {
  name: 'Login',
  middleware: 'auth',
  auth: 'guest',
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
    }
  },
  methods: {
    async submit() {
      this.$store.dispatch('TOGGLE_LOADING', true)
      try {
        await this.$auth.loginWith('laravelSanctum', {
          data: {
            email: this.form.email,
            password: this.form.password,
          },
        })
        this.$router.push('/')
      } catch (err) {
        console.log(err)
      } finally {
        this.$store.dispatch('TOGGLE_LOADING', false)
      }
    },
  },
}
</script>
