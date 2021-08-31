<template>
  <div class="border-t border-b border-soft-gray">
    <div class="container mx-auto flex justify-between">
      <NuxtLink to="/">
        <IconLogo class="transform scale-90" />
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
        <NuxtLink
          v-for="nav in navigationGroups.data"
          :key="nav.id"
          :to="`/products?category=${nav.slug}`"
          >{{ nav.name }}</NuxtLink
        >
        <NuxtLink to="/fresh-blooms">About Us</NuxtLink>
      </div>
      <InputSearch class="self-center" />
    </div>
  </div>
</template>

<script>
import { useGetNavigationGroups } from '@/composables/useNavigationGroup'

export default {
  setup() {
    const { navigationGroups, getNavigationGroups } = useGetNavigationGroups()

    console.log('fewfefe', navigationGroups)
    return { navigationGroups, getNavigationGroups }
  },
}
</script>

<style></style>
