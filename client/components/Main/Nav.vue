<template>
  <div class="border-t border-b border-soft-gray font-serif relative">
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
        <div
          v-for="{ id, slug, name } in navigationGroups.data"
          :key="id"
          class="group relative"
        >
          <NuxtLink
            :to="`/products?group=${slug}`"
            :class="{ 'cursor-default': $route.query.group === slug }"
            >{{ name }}</NuxtLink
          >
          <div
            class="
              cursor-pointer
              h-0.5
              transition-all
              duration-300
              absolute
              top-8
              bg-primary
            "
            :class="[
              $route.query.group !== slug ? 'w-0 group-hover:w-full' : 'w-full',
            ]"
          ></div>
          <!-- <div> -->
          <div
            class="
              fixed
              opacity-0
              h-0
              shadow-sm
              overflow-hidden
              transition-all
              duration-300
              z-10
              w-full
              left-0
            "
            :class="{
              'group-hover:bg-transparent group-hover:h-auto group-hover:overflow-visible group-hover:opacity-100 group-hover:top-24 group-hover:pt-12':
                $route.query.group !== slug,
            }"
          >
            <div class="bg-white py-4">
              <div class="container mx-auto">
                <p class="text-6xl font-sans mb-10 text-[#F2F2F2]">
                  {{ name }}
                </p>
                <div class="grid grid-cols-3 pl-5">
                  <div class="flex flex-col">
                    <ContainedImage
                      src="/flower-7.png"
                      class="mb-5"
                      :is-fluid="false"
                      width="150"
                      height="150"
                    />
                    <p class="font-bold text-primary mb-3">Bloom Loop</p>
                    <ul class="text-secondary font-medium font-sans">
                      <li>Petite</li>
                      <li>Signature</li>
                      <li>Deluxe</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- </div> -->
        </div>
        <NuxtLink to="/about-us">About Us</NuxtLink>
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
