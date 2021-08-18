<template>
  <div class="card border-0 shadow-sm p-4">
    <div class="card-body">
      <h5>Filter Data</h5>
      <div class="row mt-3">
        <div class="col-12 col-xl-5">
          <BaseInput
            v-model="form.search"
            type="text"
            placeholder="Serach users's name / email"
            form-for="formSearch"
            label="Search"
          />
        </div>
        <div class="col-12 col-xl-7">
          <label class="form-label">User Roles</label>
          <div class="d-flex align-items-end">
            <BaseCheckbox
              v-model="form.roles.customer"
              label="Customer"
              form-for="checkEmployee"
            />
            <BaseCheckbox
              v-model="form.roles.admin"
              label="Admin"
              form-for="checkAdmin"
            />
            <BaseCheckbox
              v-model="form.roles.superadmin"
              label="Super Admin"
              form-for="checkSuperadmin"
            />
          </div>
        </div>
        <hr class="my-2" />
        <div class="col-12 text-end mt-3">
          <button class="btn btn-secondary px-5" @click="resetForm()">
            Reset
          </button>
          <button class="btn btn-primary px-5" @click="getUsers">Filter</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapActions } from 'vuex'
export default {
  name: 'UsersFilterPanel',
  data() {
    return {
      form: {
        roles: {
          customer: true,
          admin: true,
          superadmin: true,
        },
        search: '',
      },
    }
  },
  mounted() {
    this.getUsers()
  },
  methods: {
    ...mapActions({
      GET_USERS: 'users/GET_USERS',
    }),
    ...mapMutations({
      SET_QUERY: 'users/SET_QUERY',
    }),
    async getUsers() {
      this.setQueryString()
      const [_, error] = await this.$async(this.GET_USERS({}))
      if (error) {
        this.$errorHandler('Something went wrong. Please try again later.')
        return
      }
      this.$successHandler()
    },
    setQueryString() {
      let qs = this.$qsHandler('search', this.form.search)
      for (const prop in this.form.roles) {
        if (this.form.roles[prop]) {
          qs += this.$qsHandler(prop, this.form.roles[prop])
        }
      }
      this.SET_QUERY(qs)
    },
    resetForm() {
      for (const role in this.form.roles) {
        this.form.roles[role] = true
      }
      this.form.search = ''
    },
  },
}
</script>

<style></style>
