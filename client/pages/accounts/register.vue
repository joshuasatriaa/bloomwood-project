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
          label="email address"
          class="mb-7"
          :error="errors.email"
        />
        <InputText
          id="password"
          v-model="form.password"
          type="password"
          label="password"
          class="mb-7"
          :error="errors.password"
        />
        <InputText
          id="password-confirmation"
          v-model="form.confirmPassword"
          type="password"
          label="confirm password"
          class="mb-7"
          :error="errors.password"
        />
        <InputText
          id="full-name"
          v-model="form.fullName"
          type="text"
          label="full name"
          class="mb-7"
          :error="errors.name"
        />
        <InputText
          id="phone-number"
          v-model="form.phoneNumber"
          type="tel"
          pattern="\d{8,13}"
          label="phone number (ex.081234567890)"
          class="mb-7"
          :error="errors.phone_number"
        />
        <InputText
          id="address"
          v-model="form.address"
          type="text"
          label="address"
          class="mb-7"
          :error="errors.address"
        />
        <!-- <InputText
          id="area"
          v-model="form.area"
          type="text"
          label="Area"
          class="mb-7"
        /> -->
        <InputSelect
          id="area"
          v-model="form.area"
          :options="areas"
          label="select area"
          class="mb-7"
          :error="errors.address_area_id"
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
          <NuxtLink to="/accounts/login" class="text-pink hover:text-red-400"
            >sign in</NuxtLink
          >
        </p>
      </form>
    </AccountCardContainer>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Register',
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
      errors: {},
      areas: [],
    }
  },
  async fetch() {
    const res = await this.GET_ADDRESS_AREAS({})
    this.areas = res.data.map((address) => {
      return {
        id: address.id,
        label: address.name,
        value: address.id,
      }
    })
  },
  computed: {
    ...mapGetters({
      ADDRESS_AREA: 'addressAreas/ADDRESS_AREA',
    }),
  },
  methods: {
    ...mapActions({
      GET_ADDRESS_AREAS: 'addressAreas/GET_ADDRESS_AREAS',
    }),
    async register() {
      const [_, err] = await this.$async(
        this.$axios.$post('/register', {
          name: this.form.fullName,
          email: this.form.email,
          password: this.form.password,
          password_confirmation: this.form.confirmPassword,
          phone_number: this.form.phoneNumber,
          address: this.form.address,
          address_area_id: this.form.area,
        })
      )

      if (err) {
        this.errors = err.response.data.errors
      }
    },
  },
}
</script>
