<template>
  <div class="container-fluid px-xl-7">
    <h1>Edit User</h1>
    <UsersForm :update-form="true" />
  </div>
</template>

<script>
export default {
  name: 'UsersIdEdit',
  middleware: 'auth',
}
</script>

<style></style>
