<template>
  <div class="d-inline">
    <button
      class="btn text-white"
      :class="{ 'bg-danger': !isSuspended, 'bg-success': isSuspended }"
      @click="handleClick()"
    >
      <span v-if="isSuspended">UN-SUSPEND</span
      ><span v-else>SUSPEND ACCOUNT</span>
    </button>
  </div>
</template>

<script>
export default {
  name: 'UsersSuspendButton',
  props: {
    isSuspended: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    async handleClick() {
      let url = ''
      this.isSuspended
        ? (url = '/api/unsuspend-user/')
        : (url = '/api/suspend-user/')
      const [_, error] = await this.$async(
        this.$axios.$post(url + this.$route.params.id)
      )
      if (error) {
        this.$inputWarning(error)
        return
      }

      await this.$store.dispatch('users/GET_USER', this.$route.params.id)
      this.$successHandler('Successfully change suspend status')
    },
  },
}
</script>

<style></style>
