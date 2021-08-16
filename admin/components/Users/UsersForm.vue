<template>
  <div class="container mt-5">
    <div class="card p-5">
      <div v-if="updateForm" class="card-title">
        <h5 class="text-success fw-normal">
          <span class="badge bg-secondary p-2">UPDATE ACCOUNT DATA FORM</span>
        </h5>
      </div>
      <div class="card-body">
        <BaseInput
          v-model="form.name"
          type="text"
          placeholder="example@email.com"
          form-for="formName"
          label="User's Name"
          required
        />
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
        />
        <div v-if="updateForm" class="mb-2 mt-n3">
          <small class="text-danger"
            >Please don't fill if you don't want to update the password.</small
          >
        </div>
        <BaseSelect
          v-model="form.role_uuid"
          label="Choose Role"
          form-for="formRole"
          :options="roleOptions"
        />

        <div class="mt-4">
          <ThePinModal />
          <p v-if="!hasPin" class="text-danger mb-0 mt-2">Please enter PIN.</p>
        </div>

        <button
          type="button"
          class="btn btn-success w-100 mt-3"
          :class="{ disabled: isDisable }"
          :disable="isDisable"
          @click="submitForm()"
        >
          <span v-if="updateForm">UPDATE</span><span v-else>SUBMIT</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'UsersForm',
  props: {
    updateForm: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        pin: null,
        role_uuid: '',
      },
      roleOptions: [],
    }
  },
  computed: {
    ...mapGetters({
      PIN: 'pinModal/PIN',
      ROLES: 'roles/ROLES',
      USER: 'users/USER',
    }),
    hasPin() {
      return this.PIN.length === 6
    },
    isDisable() {
      for (const prop in this.form) {
        if (!this.form[prop]) {
          if (prop === 'password' && this.updateForm) {
            continue
          }
          return true
        }
      }
      return false
    },
  },
  watch: {
    PIN() {
      this.form.pin = this.PIN
    },
  },
  mounted() {
    this.initRoleOptions()
    if (this.updateForm) {
      this.initUserData()
    }
  },
  methods: {
    ...mapActions({
      STORE_USER: 'users/STORE_USER',
      GET_ROLES: 'roles/GET_ROLES',
      GET_USER: 'users/GET_USER',
      UPDATE_USER: 'users/UPDATE_USER',
    }),
    async initRoleOptions() {
      const [_, error] = await this.$async(this.GET_ROLES())
      if (!error) {
        this.ROLES.data.forEach((x) => {
          this.roleOptions.push({
            id: x.uuid,
            value: x.uuid,
            label: x.name,
          })
        })
      }
    },
    async initUserData() {
      const [_, error] = await this.$async(this.GET_USER(this.$route.params.id))
      if (error) {
        this.$errorHandler()
        return
      }

      const currentUser = this.USER.data
      this.form.name = currentUser.name
      this.form.email = currentUser.email
      this.form.role_uuid = currentUser.role.uuid

      this.$successHandler()
    },
    submitForm() {
      this.$toast.clear()
      if (!this.updateForm) {
        this.storeUser()
        return
      }

      this.updateUser()
    },
    async updateUser() {
      const [_, error] = await this.$async(
        this.UPDATE_USER({ id: this.$route.params.id, payload: this.form })
      )
      if (error) {
        this.$inputWarning(error)
        return
      }

      this.$successHandler('Changes saved.')
      this.$router.push(`/users/${this.$route.params.id}`)
    },
    async storeUser() {
      const [_, error] = await this.$async(this.STORE_USER(this.form))
      if (error) {
        this.$inputWarning(error)
        return
      }

      this.$successHandler('Data saved.')
      this.$router.push('/users')
    },
  },
}
</script>

<style></style>
