<template>
  <div>
    <form @submit.prevent="logMeIn()">
      <input
        v-model="form.email"
        type="email"
        placeholder="example@email.com"
        form-for="formEmail"
        label="E-mail Address"
        required
      />
      <input
        v-model="form.password"
        type="password"
        placeholder="Password"
        form-for="formPassword"
        label="Password"
        required
      />
      <input
        v-model="form.confirmPassword"
        type="password"
        placeholder="Password"
        form-for="formConfirmPassword"
        label="Password"
        required
      />
      <input
        v-model="form.fullName"
        type="text"
        placeholder="Full Name"
        form-for="formFullName"
        label="Full Name"
        required
      />
      <input
        v-model="form.phoneNumber"
        type="number"
        placeholder="Phone Number"
        form-for="formPhoneNumber"
        label="Phone Number"
        required
      />
      <input
        v-model="form.area"
        type="text"
        placeholder="Area"
        form-for="formArea"
        label="Area"
        required
      />
      <NuxtLink to="/forgot-password">Forget Password?</NuxtLink>

      <button
        type="submit"
        class="btn btn-primary w-100 mt-3 text-white"
        style="width: 50px; color: black"
      >
        LOGIN
      </button>
    </form>
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
    async logMeIn() {
      this.$store.dispatch('TOGGLE_LOADING', true)
      try {
        await this.$auth.loginWith('laravelSanctum', {
          data: {
            email: this.form.email,
            password: this.form.password,
          },
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
