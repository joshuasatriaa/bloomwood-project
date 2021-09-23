<template>
  <div class="container mx-auto">
    <div class="flex justify-center sm:justify-between mb-16">
      <div class="min-w-[96px] hidden sm:block"></div>
      <h2 class="text-3xl font-bold text-primary text-center font-serif">
        What People Say
      </h2>
      <div class="hidden sm:flex gap-x-4">
        <button
          type="button"
          class="
            w-10
            h-10
            rounded-full
            border border-primary
            flex
            justify-center
            items-center
            c-swiper-button-prev
          "
        >
          <IconPrevious class="fill-current scale-90" />
        </button>
        <button
          type="button"
          class="
            w-10
            h-10
            rounded-full
            border border-primary
            flex
            justify-center
            items-center
            transform
            rotate-180
            c-swiper-button-next
          "
        >
          <IconPrevious class="fill-current scale-90" />
        </button>
      </div>
    </div>
    <div class="h-96">
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
      TESTIMONIES: 'home/TESTIMONIES',
    }),
  },
  mounted() {
    this.swiper = new this.$swiper('.mySwiper', {
      initialSlide: 1,
      spaceBetween: 60,
      centeredSlides: true,
      slidesPerView: 1,
      loop: true,
      navigation: {
        nextEl: '.c-swiper-button-next',
        prevEl: '.c-swiper-button-prev',
      },
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
      GET_TESTIMONIES: 'home/GET_TESTIMONIES',
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
