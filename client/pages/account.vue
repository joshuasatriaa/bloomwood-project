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
            tab !== $route.query.tab
              ? 'text-primary hover:border-primary hover:rounded-md'
              : 'bg-primary text-white rounded-md cursor-default',
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
            capitalize
          "
          @click="() => changeTab(tab)"
        >
          {{ tab.replace('-', ' ') }}
        </button>
      </div>
    </div>
    <div v-if="$route.query.tab" class="w-full">
      <AccountInfo v-if="$route.query.tab === 'my-account'" />
      <AccountOrderHistory v-else-if="$route.query.tab === 'order-history'" />
      <AccountChangePassword
        v-else-if="$route.query.tab === 'change-password'"
      />
      <div v-else-if="$route.query.tab === 'log-out'">Logging Out</div>
      <div v-else></div>
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
      tabs: ['my-account', 'order-history', 'change-password', 'log-out'],
    }
  },
  head() {
    return {
      script: [
        {
          hid: 'midtranssnap',
          type: 'text/javascript',
          src: 'https://app.sandbox.midtrans.com/snap/snap.js',
          'data-client-key': process.env.MIDTRANS_CLIENT_KEY || null,
          callback: () => {
            this.snapOnMount()
          },
        },
      ],
    }
  },
  mounted() {
    // if (
    //   this.$route.query.payment_token &&
    //   this.$route.query.tab !== 'order-history'
    // ) {
    //   this.$router.push({
    //     path: this.$route.fullPath,
    //     query: { tab: 'order-history' },
    //   })
    //   return
    // }

    if (!this.$route.query.tab) {
      this.$router.push({
        path: this.$route.fullPath,
        query: { tab: 'my-account' },
      })
    }
  },
  methods: {
    snapOnMount() {
      if (this.$route.query.payment_token) {
        window.snap.pay(this.$route.query.payment_token)
      }
    },
    async logMeOut() {
      const [_, error] = await this.$async(this.$auth.logout())
      if (error) {
        alert(error)
        return
      }
      this.$router.push('/')
    },
    changeTab(clickedTab) {
      if (clickedTab === 'log-out') {
        return this.$modal.show('modal-logout')
        // return this.logMeOut()
      }
      this.$router.push({
        path: this.$route.fullPath,
        query: { tab: clickedTab },
      })
    },
  },
}
</script>
<style></style>
