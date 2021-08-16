<template>
  <div class="container-fluid px-xl-7">
    <h1>Detil Pengguna</h1>
    <div v-if="USER" class="row mt-5">
      <div class="col text-end">
        <NuxtLink
          :to="`/users/${$route.params.id}/edit`"
          class="btn btn-primary"
        >
          Ubah Data Pengguna</NuxtLink
        >
        <UsersSuspendButton :is-suspended="USER.is_suspended" />
      </div>
    </div>
    <div class="row mt-3 mt-lg-5">
      <div class="col-12 col-xl-4 text-center">
        <img
          src="~/assets/images/temp-profile.jpg"
          class="object-fit-cover shadow rounded-3"
          alt="foto profil"
          width="250"
          height="250"
        />
      </div>
      <div
        v-if="USER && !LOADING"
        class="col-12 col-xl-8 mt-3 mt-xl-0 d-flex align-items-center"
      >
        <table
          v-show="USER.uuid == $route.params.id && !LOADING"
          class="table table-borderless"
        >
          <tbody>
            <tr v-for="(field, index) in fields" :key="index">
              <th scope="row" class="py-2">{{ field.label }}</th>
              <th scope="row" class="py-2 text-primary fw-normal">
                <span v-if="field.label === 'PIN'"
                  ><UsersBadge :boolean="field.value"
                /></span>
                <span v-else-if="field.label === 'Suspensi'">
                  <UsersBadge
                    :boolean="field.value"
                    true-label="Benar"
                    true-class="bg-danger"
                    false-label="Tidak"
                    false-class="bg-success"
                  />
                </span>
                <span v-else>{{ field.value }} </span>
              </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <hr class="my-5" />
  </div>
</template>

<script>
export default {
  name: 'UsersId',
  middleware: 'auth',
  data() {
    return {
      fields: {
        uuid: {
          label: 'UUID',
          value: '',
        },
        name: {
          label: 'Nama',
          value: '',
        },
        email: {
          label: 'Email',
          value: '',
        },
        role: {
          label: 'Peran',
          value: '',
        },
        pin: {
          label: 'PIN',
          value: false,
        },
        suspended: {
          label: 'Suspensi',
          value: false,
        },
      },
      profilePic: '',
    }
  },
  computed: {
    USER() {
      return this.$store.getters['users/USER'].data
    },
    LOADING() {
      return this.$store.getters.LOADING
    },
  },
  watch: {
    USER() {
      this.initData()
    },
  },
  async mounted() {
    const [_, error] = await this.$async(
      this.$store.dispatch('users/GET_USER', this.$route.params.id)
    )
    if (error) {
      this.$errorHandler('Sesuatu bermasalah. Coba muat ulang halaman ini.')
      return
    }

    this.initData()
  },
  methods: {
    initData() {
      this.fields.uuid.value = this.USER.uuid
      this.fields.name.value = this.USER.name
      this.fields.email.value = this.USER.email
      this.fields.role.value = this.USER.role.name
      this.fields.pin.value = this.USER.has_pin
      this.fields.suspended.value = this.USER.is_suspended
    },
  },
}
</script>

<style></style>
