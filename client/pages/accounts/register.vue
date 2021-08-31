<template>
  <div class="container mx-auto text-primary pt-20">
    <AccountCardContainer
      title="Sign Up"
      description="please enter your information below"
    >
      <form @submit.prevent="register()">
        <InputText
          id="email"
          v-model="form.email"
          type="email"
          label="E-mail Address"
          class="mb-7"
        />
        <InputText
          id="password"
          v-model="form.password"
          type="password"
          label="Password"
          class="mb-7"
        />
        <InputText
          id="password-confirmation"
          v-model="form.confirmPassword"
          type="password"
          label="Password"
          class="mb-7"
        />
        <InputText
          id="full-name"
          v-model="form.fullName"
          type="text"
          label="Full Name"
          class="mb-7"
        />
        <InputText
          id="phone-number"
          v-model="form.phoneNumber"
          type="number"
          label="Phone Number"
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
            mb-10
          "
        >
          create account
        </button>
        <p class="font-bold text-center">
          already have an account ?
          <NuxtLink to="/accounts/register" class="text-pink">sign in</NuxtLink>
        </p>
      </form>
    </AccountCardContainer>
  </div>
</template>

<script>
export default {
  middleware: 'auth',
  auth: 'guest',
  data() {
    return {
      form: {
        email: '',
        password: '',
        confirmPassword: '',
        fullName: '',
        phoneNumber: '',
        address: '',
        area: '',
      },
    }
  },
  methods: {
    async register() {
      this.$store.dispatch('TOGGLE_LOADING', true)
      try {
        await this.$axios.$post('/api/users', {
          name: this.form.fullName,
          email: this.form.email,
          password: this.form.password,
        })
        this.$router.push('/home')
      } catch (err) {
        console.log(err)
      } finally {
        this.$store.dispatch('TOGGLE_LOADING', false)
      }
    },
  },
}
</script>
