<template>
  <div class="border-t border-b border-soft-gray">
    <div class="container mx-auto flex justify-between">
      <NuxtLink to="/">
        <IconLogo />
      </NuxtLink>
      <div
        class="
          flex
          justify-around
          flex-grow
          px-10
          items-center
          font-bold
          text-primary
        "
      >
        <NuxtLink to="/fresh-blooms">Fresh Blooms</NuxtLink>
        <NuxtLink to="/fresh-blooms">Eternity Blooms</NuxtLink>
        <NuxtLink to="/fresh-blooms">Gifts</NuxtLink>
        <NuxtLink to="/fresh-blooms">About Us</NuxtLink>
      </div>
      <InputSearch class="self-center" />
    </div>
  </div>
</template>
<script></script>
<style></style>
