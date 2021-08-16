<template>
  <div
    class="
      container-fluid
      full-height
      d-flex
      flex-column
      justify-content-center
      align-items-center
    "
  >
    <h1 class="fw-bold display-1 text-primary">Bloomwood Florist</h1>
    <h2 class="text-primary">Admin Management System</h2>
    <h5 v-if="isAuthenticated" class="mt-4">Welcome, {{ $auth.user.name }}</h5>
    <div class="d-grid w-25 mt-3 ">
      <NuxtLink
        v-if="!isAuthenticated"
        to="/login"
        class="btn btn-primary p-3 shadow text-white"
        ><span class="fw-bold">LOGIN</span></NuxtLink
      >
      <NuxtLink v-else to="/home" class="btn btn-primary p-3 shadow text-white"
        ><span class="fw-bold">Home</span></NuxtLink
      >
    </div>
    <hr class="vw-5 mt-5" />
  </div>
</template>

<script>
export default {
  name: 'Index',
  computed: {
    isAuthenticated() {
      return this.$store.getters.isAuthenticated
    },
  },
}
</script>
