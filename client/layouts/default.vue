<template>
  <div class="overflow-x-hidden">
    <MainHeader />
    <MainNav />
    <main>
      <Nuxt />
    </main>
    <MainFooter class="mt-20" />
  </div>
</template>

<script>
export default {
  name: 'DefaultLayout',
  middleware: 'auth-ssr',
}
</script>
