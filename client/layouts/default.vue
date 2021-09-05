<template>
  <div class="overflow-x-hidden">
    <header class="fixed z-10 w-full bg-white mb-20">
      <MainHeader />
      <MainNav />
      <!-- <MainNavTemp /> -->
    </header>
    <main class="pt-36">
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
