<template>
  <div class="container mx-auto pt-20 flex">
    <div>
      <div class="first:rounded-t-md last:rounded-b-md last:text-red-900">
        <button class="w-full bg-secondary text-left text-white">
          My Account
        </button>
        <button class="w-full bg-tertiary text-primary text-left">
          Order History
        </button>
        <button class="w-full bg-tertiary text-primary text-left">
          Change Password
        </button>
        <button class="w-full bg-tertiary text-primary text-left">
          Log Out
        </button>
      </div>
    </div>
    <div class="w-full">
      <AccountInfo />
    </div>
  </div>
</template>
<script>
export default {}
</script>
<style></style>
