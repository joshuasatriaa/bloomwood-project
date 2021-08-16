<template>
  <div class="main-content">
    <transition name="fade">
      <TheLoading v-show="isLoading" />
    </transition>
    <TheNavbar v-if="showNavbar" />
    <div class="px-lg-5 pb-10">
      <Nuxt />
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'DefaultLayout',
  computed: {
    ...mapGetters({
      isLoading: 'isLoading',
    }),
    showNavbar() {
      const excludePaths = ['', 'login', 'reset-password', 'forgot-password']
      return excludePaths.findIndex((x) => `/${x}` === this.$route.path) === -1
    },
  },
}
</script>

<style>
html {
  word-spacing: 1px;
  font-size: 16px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
  width: 100%;
  height: 100%;
  overflow-x: hidden;
}
*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}
body {
  margin: 0;
  overflow-x: hidden;
  width: 100%;
  min-height: 100vh;
  position: relative;
}

.main-content {
  min-height: 100vh;
}

.full-height {
  min-height: 100vh;
}

.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.object-fit-cover {
  object-fit: cover;
}
</style>
