<template>
  <div
    class="
      container
      full-height
      d-flex
      flex-column
      align-items-center
      justify-content-center
    "
  >
    <div class="row w-100">
      <div
        class="col-12 col-lg-8 col-xl-6 d-flex justify-content-center mx-auto"
      >
        <div class="card w-100 border-0 shadow rounded-5 py-5">
          <div class="card-body d-flex flex-column align-items-center">
            <NuxtLink to="/" class="text-decoration-none">
              <h1 class="fw-bold">Bloomwood Florist</h1>
            </NuxtLink>
            <h5>Admin Management System</h5>

            <div class="w-75 mt-2">
              <form @submit.prevent="logMeIn()">
                <BaseInput
                  v-model="form.email"
                  type="email"
                  placeholder="example@email.com"
                  form-for="formEmail"
                  label="E-mail Address"
                  required
                />
                <BaseInput
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
                >
                  LOGIN
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
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
    async logMeIn() {
      this.$store.dispatch('TOGGLE_LOADING')
      try {
        await this.$auth.loginWith('laravelSanctum', {
          data: {
            email: this.form.email,
            password: this.form.password,
          },
        })
        this.$successHandler('Logged in.')
        this.$router.push('/home')
      } catch (err) {
        this.$errorHandler(
          'Something went wrong! Invalid credentials or try again later.',
          { timeout: 10000 }
        )
      } finally {
        this.$store.dispatch('TOGGLE_LOADING', false)
      }
    },
  },
}
</script>

<style></style>
