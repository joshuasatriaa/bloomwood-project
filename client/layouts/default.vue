<template>
  <div class="overflow-x-hidden">
    <header>
      <MainHeader />
      <MainNav />
    </header>
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
