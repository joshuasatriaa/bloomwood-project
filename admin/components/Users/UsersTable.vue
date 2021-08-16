<template>
  <div class="table-responsive">
    <table v-if="USERS.data" class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Peran</th>
          <th scope="col">PIN</th>
          <th scope="col">SUSPENSI</th>
          <th scope="col" class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in USERS.data" :key="user.uuid">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.role.name }}</td>
          <td>
            <UsersBadge :boolean="user.has_pin" />
          </td>
          <td>
            <UsersBadge
              :boolean="user.is_suspended"
              true-label="Benar"
              true-class="bg-danger"
              false-label="Tidak"
              false-class="bg-success"
            />
          </td>
          <td class="text-end">
            <NuxtLink :to="`/users/${user.uuid}`" class="btn btn-primary"
              >Pengaturan Pengguna</NuxtLink
            >
          </td>
        </tr>
        <tr v-if="!USERS.data.length">
          <td colspan="6" class="text-center">
            <span class="text-danger fw-bold">Data tidak ditemukan.</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'UsersTable',
  computed: {
    ...mapGetters({
      USERS: 'users/USERS',
    }),
  },
}
</script>

<style scoped>
th,
td {
  vertical-align: baseline !important;
}
</style>
