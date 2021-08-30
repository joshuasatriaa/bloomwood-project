<template>
  <div>
    <MainHeader />
    <MainNav />
    <Nuxt />
    <MainFooter class="mt-20" />
  </div>
</template>

<script>
export default {
  name: 'DefaultLayout',
  middleware: 'auth-ssr',
}
</script>
