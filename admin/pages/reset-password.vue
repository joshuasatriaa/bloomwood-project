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
      <div class="col-12 col-lg-6 d-flex justify-content-center mx-auto">
        <div class="card w-100 border-0 shadow rounded-5 py-5">
          <div class="card-body d-flex flex-column align-items-center">
            <h1 class="fw-bold">Traffic Boost</h1>
            <h5 class="fw-bold">Reset your password</h5>
            <div class="w-75 mt-4">
              <form @submit.prevent="resetPassword()">
                <BaseInput
                  v-model="form.email"
                  type="email"
                  placeholder="example@email.com"
                  form-for="formEmail"
                  label="E-mail"
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
                <BaseInput
                  v-model="form.password_confirmation"
                  type="password"
                  placeholder="Confirm Password"
                  form-for="formPasswordConfirmation"
                  label="Confirm Password"
                  required
                />
                <NuxtLink to="/login">Cancel</NuxtLink>
                <button type="submit" class="btn btn-primary w-100 mt-4">
                  Reset Password
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
  name: 'ResetPassword',
  middleware: 'auth',
  auth: 'guest',
  data() {
    return {
      form: {
        email: '',
        password: '',
        password_confirmation: '',
      },
    }
  },
  methods: {
    async resetPassword() {
      this.form.token = this.$route.query.token

      await this.$axios.$get('/sanctum/csrf-cookie')
      const [_, error] = await this.$async(
        this.$axios.$post('/reset-password', this.form)
      )
      if (error) {
        this.$errorHandler('Request failed! Please retry or try again later.', {
          timeout: 10000,
        })
        return
      }
      this.$successHandler('Success! Your password has been changed!')
      this.$router.push('/login')
    },
  },
}
</script>

<style></style>
