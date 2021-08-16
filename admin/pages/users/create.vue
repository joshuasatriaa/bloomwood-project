<template>
  <div class="container-fluid px-xl-7">
    <h1>Tambah Pengguna Baru</h1>
    <UsersForm />
  </div>
</template>

<script>
export default {
  name: 'UsersCreate',
  middleware: 'auth',
}
</script>

<style></style>
