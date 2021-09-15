<template>
  <div class="border-t border-b border-soft-gray font-serif relative">
    <div class="container mx-auto flex justify-between items-center h-20">
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
          v-for="{ id, name, categories } in NAVIGATION_GROUPS.data"
          :key="id"
          class="group relative"
        >
          <div class="relative">
            <span class="cursor-default">{{ name }}</span>
            <div
              class="
                cursor-pointer
                h-0.5
                transition-all
                duration-300
                absolute
                top-8
                bg-primary
                w-0
                group-hover:w-full
              "
            ></div>
          </div>
          <div
            class="
              fixed
              w-full
              z-10
              left-0
              transition-all
              scale-y-0
              origin-top
              opacity-0
              duration-300
              top-36
              border-b
              pt-8
            "
            :class="{
              'group-hover:scale-y-100 group-hover:top-[5.7rem] group-hover:opacity-100':
                showDropdown,
            }"
          >
            <div class="bg-white py-4">
              <div class="container mx-auto">
                <p class="text-6xl font-sans mb-10 text-[#F2F2F2]">
                  {{ name }}
                </p>
                <div class="grid grid-cols-7 pl-5">
                  <div
                    v-for="category in categories"
                    :key="category.id"
                    class="flex flex-col"
                  >
                    <NuxtLink
                      :to="`/products?category=${category.slug}`"
                      @click.native="temporaryHideDropdown"
                    >
                      <ContainedImage
                        :src="category.thumbnail_image"
                        class="mb-5 max-w-[150px]"
                        width="150"
                        height="150"
                      />
                    </NuxtLink>
                    <NuxtLink
                      :to="`/products?category=${category.slug}`"
                      class="font-bold text-primary mb-3"
                      @click.native="temporaryHideDropdown"
                    >
                      {{ category.label }}
                    </NuxtLink>
                    <ul class="text-secondary font-medium font-sans">
                      <li v-for="child in category.children" :key="child.id">
                        <NuxtLink
                          :to="`/products?category=${child.slug}`"
                          @click.native="temporaryHideDropdown"
                          >{{ child.label }}</NuxtLink
                        >
                      </li>
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
      <InputSearch class="hidden sm:block xl:max-w-[300px] mx-5" />
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
          @click="() => toggleModal(false)"
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
        <InputSearch class="w-11/12" />
      </div>
      <div class="flex flex-col pt-12 items-center gap-y-6 mb-10">
        <template v-for="{ id, name, categories } in NAVIGATION_GROUPS.data">
          <Accordion
            :key="`${id}-sm`"
            class="w-11/12"
            :title="name"
            :default-open="false"
          >
            <div
              class="
                grid grid-cols-1
                sm:grid-cols-3
                md:grid-cols-5
                xl:grid-cols-6
                gap-y-6
                pl-5
              "
            >
              <div
                v-for="category in categories"
                :key="category.id"
                class="flex flex-col"
              >
                <NuxtLink
                  :to="`/products?category=${category.slug}`"
                  @click.native="() => toggleModal(false)"
                >
                  <ContainedImage
                    :src="category.thumbnail_image"
                    class="mb-5 max-w-[150px]"
                    width="150"
                    height="150"
                  />
                </NuxtLink>
                <NuxtLink
                  :to="`/products?category=${category.slug}`"
                  class="font-bold text-primary mb-3"
                  @click.native="() => toggleModal(false)"
                >
                  {{ category.label }}
                </NuxtLink>
                <ul class="text-secondary font-medium font-sans">
                  <li v-for="child in category.children" :key="child.id">
                    <NuxtLink
                      :to="`/products?category=${child.slug}`"
                      @click.native="() => toggleModal(false)"
                      >{{ child.label }}</NuxtLink
                    >
                  </li>
                </ul>
              </div>
            </div>
          </Accordion>
        </template>
        <!-- <button
          v-for="{ id, slug, name } in NAVIGATION_GROUPS.data"
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
        </button> -->
      </div>
    </modal>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  data() {
    return {
      isOpen: false,
      showDropdown: true,
    }
  },
  async fetch() {
    await this.GET_NAVIGATION_GROUPS({})
  },
  computed: {
    ...mapGetters({
      NAVIGATION_GROUPS: 'NAVIGATION_GROUPS',
    }),
  },
  methods: {
    ...mapActions({
      GET_NAVIGATION_GROUPS: 'GET_NAVIGATION_GROUPS',
    }),
    temporaryHideDropdown() {
      this.showDropdown = false
      setTimeout(() => {
        this.showDropdown = true
      }, 200)
    },
    toggleModal(openBool) {
      this.isOpen = openBool
      openBool ? this.$modal.show('sm-nav') : this.$modal.hide('sm-nav')
    },
  },
}
</script>

<style></style>
