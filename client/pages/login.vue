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
      <NuxtLink to="/forgot-password">Forget Password?</NuxtLink>

      <button
        type="submit"
        class="btn btn-primary w-100 mt-3 text-white"
        style="width: 50px; color: black"
      >
        LOGIN
      </button>
      <NuxtLink to="/test">go to protected?</NuxtLink>
      <NuxtLink to="/">go to index</NuxtLink>
    </form>
  </div>
</template>

<script>
export default {
  middleware: ['auth-ssr', 'auth'],
  auth: 'guest',
  // middleware: 'guest',
  data() {
    return {
      form: {
        email: '',
        password: '',
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
