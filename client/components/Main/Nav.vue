<template>
  <div class="border-t border-b border-soft-gray font-serif relative">
    <div class="container mx-auto flex justify-between items-center h-24">
      <NuxtLink to="/">
        <ContainedImage
          src="/logo.svg"
          width="370"
          height="120"
          class="max-w-[150px] sm:max-w-[200px]"
        />
      </NuxtLink>
      <div
        class="
          hidden
          xl:flex
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
            class="relative"
          >
            <span>{{ name }}</span>
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
                $route.query.group !== slug
                  ? 'w-0 group-hover:w-full'
                  : 'w-full',
              ]"
            ></div>
          </NuxtLink>
          <div
            class="
              fixed
              h-0
              w-full
              z-10
              left-0
              transition-all
              scale-y-0
              origin-top
              opacity-0
              duration-300
              top-36
            "
            :class="{
              'group-hover:w-full group-hover:scale-y-100  group-hover:opacity-100 group-hover:h-auto group-hover:top-24 group-hover:pt-[2.6rem]':
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
        </div>
        <NuxtLink
          v-for="{ slug, name } in [{ slug: 'about-us', name: 'About Us' }]"
          :key="slug"
          to="/about-us"
          class="relative group"
        >
          <span>{{ name }}</span>
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
              $route.name !== slug ? 'w-0 group-hover:w-full' : 'w-full',
            ]"
          ></div>
        </NuxtLink>
      </div>
      <InputSearch class="hidden sm:block max-w-[300px] mx-5" />
      <div class="relative block xl:hidden">
        <button
          class="text-gray-500 w-10 h-10 relative focus:outline-none bg-white"
          @click="
            () => {
              isOpen = !isOpen
              $modal.show('sm-nav')
            }
          "
        >
          <span class="sr-only">open main menu</span>
          <div
            class="
              block
              w-5
              absolute
              left-1/2
              top-1/2
              transform
              -translate-x-1/2 -translate-y-1/2
            "
          >
            <span
              aria-hidden="true"
              class="
                block
                absolute
                h-0.5
                w-5
                bg-current
                transform
                transition
                duration-500
                ease-in-out
              "
              :class="{ 'rotate-45': isOpen, ' -translate-y-1.5': !isOpen }"
            ></span>
            <span
              aria-hidden="true"
              class="
                block
                absolute
                h-0.5
                w-5
                bg-current
                transform
                transition
                duration-500
                ease-in-out
              "
              :class="{ 'opacity-0': isOpen }"
            ></span>
            <span
              aria-hidden="true"
              class="
                block
                absolute
                h-0.5
                w-5
                bg-current
                transform
                transition
                duration-500
                ease-in-out
              "
              :class="{ '-rotate-45': isOpen, ' translate-y-1.5': !isOpen }"
            ></span>
          </div>
        </button>
      </div>
    </div>
    <modal
      name="sm-nav"
      width="100%"
      height="0"
      classes="h-screen w-screen top-0 transition-all bg-tertiary overflow-y-auto overflow-x-hidden"
    >
      <div class="flex w-full justify-between px-5 pt-5">
        <ContainedImage
          src="/logo.svg"
          width="370"
          height="120"
          class="max-w-[120px]"
        />
        <button
          class="text-gray-500 w-10 h-10 relative focus:outline-none"
          @click="
            () => {
              isOpen = !isOpen
              $modal.hide('sm-nav')
            }
          "
        >
          <span class="sr-only">open main menu</span>
          <div
            class="
              block
              w-5
              absolute
              left-1/2
              top-1/2
              transform
              -translate-x-1/2 -translate-y-1/2
            "
          >
            <span
              aria-hidden="true"
              class="
                block
                absolute
                h-0.5
                w-5
                bg-current
                transform
                transition
                duration-500
                ease-in-out
              "
              :class="{ 'rotate-45': isOpen, ' -translate-y-1.5': !isOpen }"
            ></span>
            <span
              aria-hidden="true"
              class="
                block
                absolute
                h-0.5
                w-5
                bg-current
                transform
                transition
                duration-500
                ease-in-out
              "
              :class="{ 'opacity-0': isOpen }"
            ></span>
            <span
              aria-hidden="true"
              class="
                block
                absolute
                h-0.5
                w-5
                bg-current
                transform
                transition
                duration-500
                ease-in-out
              "
              :class="{ '-rotate-45': isOpen, ' translate-y-1.5': !isOpen }"
            ></span>
          </div>
        </button>
      </div>
      <div class="flex justify-center mt-10">
        <InputSearch class="max-w-[250px]" />
      </div>
      <div class="flex flex-col pt-12 items-center gap-y-6">
        <button
          v-for="{ id, slug, name } in navigationGroups.data"
          :key="id"
          :class="{ 'cursor-default': $route.query.group === slug }"
          class="relative group"
          @click="
            () => {
              $router.push(`/products?group=${slug}`)
              $modal.hide('sm-nav')
              isOpen = !isOpen
            }
          "
        >
          <span>{{ name }}</span>
          <div
            class="
              cursor-pointer
              h-0.5
              transition-all
              duration-300
              absolute
              top-7
              bg-primary
            "
            :class="[
              $route.query.group !== slug ? 'w-0 group-hover:w-full' : 'w-full',
            ]"
          ></div>
        </button>
        <button
          v-for="{ slug, name } in [{ slug: 'about-us', name: 'About Us' }]"
          :key="slug"
          class="relative group"
          @click="
            () => {
              $router.push(`/${slug}`)
              $modal.hide('sm-nav')
              isOpen = !isOpen
            }
          "
        >
          <span>{{ name }}</span>
          <div
            class="
              cursor-pointer
              h-0.5
              transition-all
              duration-300
              absolute
              top-7
              bg-primary
            "
            :class="[
              $route.name !== slug ? 'w-0 group-hover:w-full' : 'w-full',
            ]"
          ></div>
        </button>
      </div>
    </modal>
  </div>
</template>

<script>
import { useGetNavigationGroups } from '@/composables/useNavigationGroup'

export default {
  setup() {
    const { navigationGroups, getNavigationGroups } = useGetNavigationGroups()
    return { navigationGroups, getNavigationGroups }
  },
  data() {
    return {
      isOpen: false,
    }
  },
}
</script>

<style></style>
