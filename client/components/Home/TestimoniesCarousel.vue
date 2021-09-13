<template>
  <div class="swiper-container mySwiper w-full container">
    <div class="swiper-wrapper m-0">
      <div
        v-for="testimony in TESTIMONIES.data"
        :key="testimony.id"
        class="swiper-slide relative transition-all"
      >
        <div
          class="
            relative
            border-4 border-primary
            rounded-lg
            text-center text-primary
            px-4
            md:px-5
            xl:px-10
            flex flex-col
            items-center
            justify-center
            min-h-[290px]
          "
        >
          <p class="mb-7 font-bold line-clamp-7">
            {{ testimony.message }}
          </p>
          <div>
            <span>{{ testimony.name }}</span>
          </div>
          <IconDoubleQuotes class="absolute right-5 bottom-5" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'TestimoniesCarousel',
  data() {
    return {
      swiper: null,
    }
  },
  async fetch() {
    await this.GET_TESTIMONIES()
  },
  computed: {
    ...mapGetters({
      TESTIMONIES: 'testimonies/TESTIMONIES',
    }),
  },
  mounted() {
    this.swiper = new this.$swiper('.mySwiper', {
      initialSlide: 1,
      spaceBetween: 60,
      centeredSlides: true,
      slidesPerView: 1,
      loop: true,
      breakpoints: {
        1024: {
          slidesPerView: 2,
          spaceBetween: 100,
        },
        1280: {
          slidesPerView: 2,
          spaceBetween: 100,
        },
        1560: {
          slidesPerView: 2.4,
          spaceBetween: 100,
        },
      },
    })
  },
  methods: {
    ...mapActions({
      GET_TESTIMONIES: 'testimonies/GET_TESTIMONIES',
    }),
  },
}
</script>

<style>
@screen lg {
  .swiper-slide-active {
    @apply scale-125;
  }
}
</style>
