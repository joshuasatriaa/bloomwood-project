<template>
  <div class="container-fluid px-xl-7">
    <h1>Add New User</h1>
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
