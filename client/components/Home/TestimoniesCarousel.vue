<template>
  <div class="swiper-container mySwiper w-full container">
    <div class="swiper-wrapper m-0">
      <div
        v-for="(slide, idx) in 10"
        :key="idx"
        class="swiper-slide relative transition-all"
      >
        <div
          class="
            relative
            border-4 border-primary
            rounded-lg
            text-center text-primary
            px-4
            md:px-10
            pt-16
            pb-10
          "
        >
          <p class="mb-7">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
            quis felis vitae odio dignissim placerat eu faucibus dolor. Quisque
            et enim massa.
          </p>
          <div>
            <span> James Klein </span>
          </div>
          <IconDoubleQuotes class="absolute right-5 bottom-5" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TestimoniesCarousel',
  data() {
    return {
      swiper: null,
    }
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
}
</script>

<style>
.swiper-slide-active {
  @apply scale-125;
}
</style>
