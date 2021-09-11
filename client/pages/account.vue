<template>
  <div
    class="container mx-auto pt-20 flex flex-col lg:flex-row gap-y-5 gap-x-10"
  >
    <div class="xl:ml-10 w-full lg:w-9/12 xl:w-6/12 2xl:w-5/12">
      <div class="font-bold bg-tertiary rounded-md">
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
            pl-5
            sm:pl-14
            text-xl
            font-bold
            py-4
          "
          @click="() => changeTab(tab)"
        >
          {{ tab }}
        </button>
      </div>
    </div>
    <div class="w-full">
      <AccountInfo v-if="selectedTab === 'My Account'" />
      <AccountOrderHistory v-else-if="selectedTab === 'Order History'" />
      <AccountChangePassword v-else-if="selectedTab === 'Change Password'" />
      <div v-else>Logging Out</div>
    </div>
    <ModalContainer
      id="modal-logout"
      title="Logout"
      desc="are you sure you want to logout?"
      btn-proceed-title="yes"
      :btn-proceed-callback="() => logMeOut()"
    />
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
  methods: {
    async logMeOut() {
      const [_, error] = await this.$async(this.$auth.logout())
      if (error) {
        alert(error)
        return
      }
      this.$router.push('/')
    },
    changeTab(clickedTab) {
      if (clickedTab === 'Log Out') {
        return this.$modal.show('modal-logout')
        // return this.logMeOut()
      }
      this.selectedTab = clickedTab
    },
  },
}
</script>
<style></style>
