<template>
  <div class="container mx-auto pt-20 flex">
    <div class="ml-10">
      <div class="font-bold bg-tertiary rounded-md w-10/12">
        <!--  -->
        <button
          v-for="tab in tabs"
          :key="tab"
          :class="[
            tab !== selectedTab
              ? 'text-primary hover:border-primary hover:rounded-md'
              : 'bg-secondary text-white rounded-md cursor-default',
          ]"
          class="
            border border-transparent
            w-full
            text-left
            pl-14
            text-xl
            font-bold
            py-4
          "
          @click="() => (selectedTab = tab)"
        >
          {{ tab }}
        </button>
      </div>
    </div>
    <div class="w-full">
      <AccountInfo />
    </div>
  </div>
</template>
<script>
export default {
  name: 'Account',
  middleware: 'auth',
  data() {
    return {
      selectedTab: 'My Account',
      tabs: ['My Account', 'Order History', 'Change Password', 'Log Out'],
    }
  },
}
</script>
<style></style>
