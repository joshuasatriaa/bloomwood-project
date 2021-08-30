<template>
  <div>
    <div class="border-t border-b border-secondary relative mb-24">
      <div
        class="
          container
          absolute
          top-1/2
          left-1/2
          transform
          -translate-x-1/2 -translate-y-1/2
        "
      >
        <div class="flex flex-col bg-white w-96 ml-28 pt-12 pb-14 px-14">
          <IconLogo class="self-center mb-12 scale-125" />
          <div class="text-primary text-xl mb-11">
            Exclusive Enternity Collection
          </div>
          <div>
            <button
              class="
                font-bold
                text-primary
                border-b-4 border-primary
                pb-3
                text-xl
                hover:border-transparent
                origin-left
                transform
                hover:scale-110
                transition
                duration-150
              "
              type="button"
            >
              Shop Now
            </button>
          </div>
        </div>
      </div>
      <img src="/main-cover.jpg" class="w-full min-h-full" />
    </div>

    <div class="grid grid-cols-5 gap-0 mb-20">
      <img v-for="(flower, idx) in 5" :key="idx" src="/flower.jpg" />
    </div>

    <div class="container mx-auto mb-20 px-10">
      <h2 class="text-3xl font-bold text-primary text-center mb-16">
        Most Gifted
      </h2>
      <div
        class="
          grid grid-cols-1
          sm:grid-cols-2
          md:grid-cols-4
          xl:grid-cols-4
          gap-x-10 gap-y-5
        "
      >
        <HomeProductItem v-for="(product, idx) in 4" :key="idx" />
      </div>
    </div>

    <div class="container mx-auto">
      <h2
        class="text-2xl sm:text-5xl md:text-7xl font-bold text-right mb-10"
        style="color: #f2f2f2"
      >
        @bloomwoodflorist
      </h2>
      <div
        class="
          grid grid-cols-1
          gap-x-2 gap-y-3
          sm:grid-cols-2
          md:grid-cols-3 md:gap-x-7 md:gap-y-8
          lg:grid-cols-4
          xl:grid-cols-5
        "
      >
        <img
          v-for="(product, idx) in 10"
          :key="idx"
          src="/flower-2.jpg"
          class="w-full"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  async fetch() {
    await this.GET_NAVIGATION_GROUPS({})
  },
  computed: {
    ...mapGetters({
      NAVIGATION_GROUPS: 'NAVIGATION_GROUPS',
    }),
  },
  methods: {
    async logMeOut() {
      // eslint-disable-next-line no-unused-vars
      const [_, error] = await this.$async(this.$auth.logout())
      if (error) {
        alert(error)
        // this.$errorHandler('Something went wrong! Please refresh this page.')
        return
      }
      this.$router.push('/')
      // this.$successHandler('Successfully logout.')
    },
    ...mapActions({
      GET_NAVIGATION_GROUPS: 'GET_NAVIGATION_GROUPS',
    }),
  },
}
</script>
