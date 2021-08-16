<template>
  <div class="container-fluid px-xl-7">
    <h1>User List</h1>
    <div class="row mt-3">
      <div class="col-12 col-xl-10 mx-auto">
        <UsersFilterPanel />
      </div>
      <div class="col-12 text-end mt-4">
        <NuxtLink to="/users/create" class="btn btn-primary shadow-sm"
          >Add User</NuxtLink
        >
      </div>
      <div class="col-12 mt-4 bg-white rounded-3 p-lg-4 shadow-sm">
        <UsersTable />
      </div>
      <div class="col-12 col-md-6 col-xl-4 ms-auto mt-3">
        <BasePagination getter="users/USERS" action="users/GET_USERS" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UsersIndex',
  middleware: 'auth',
}
</script>

<style></style>
