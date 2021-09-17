<template>
  <div>
    <!-- <button @click="payment">testtt</button> -->
    <div class="border-b border-secondary relative mb-24">
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
        <div
          class="
            flex flex-col
            bg-white
            w-11/12
            sm:w-96
            mx-auto
            md:ml-28
            pt-12
            pb-14
            px-14
          "
        >
          <IconLogo class="self-center mb-12 scale-125" />
          <div class="text-primary text-xl mb-11 font-serif">
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
      <ContainedImage
        src="/main-cover.jpg"
        width="1920"
        height="666"
        style="min-height: 666px"
      />
    </div>

    <div
      v-if="!$fetchState.pending"
      class="
        grid grid-cols-2
        sm:grid-cols-4
        gap-0
        xl:container xl:mx-auto
        mb-20
      "
    >
      <NuxtLink
        v-for="item in [...FEATURED_PRODUCTS.data].splice(0, 4)"
        :key="item.id"
        :to="`/products/${item.slug}/${item.id}`"
        class="relative group"
      >
        <div
          class="
            absolute
            top-0
            left-0
            p-3
            h-full
            w-full
            text-lg text-brown
            bg-black bg-opacity-0
            group-hover:bg-opacity-40
            flex
            items-center
            justify-center
          "
        >
          <p
            style="max-width: 12.5rem"
            class="
              font-bold
              text-lg text-white
              hidden
              group-hover:block
              font-serif
            "
          >
            {{ item.name }}
          </p>
        </div>
        <ContainedImage
          :src="item.images[0].original_image"
          width="480"
          height="578"
        />
      </NuxtLink>
      <NuxtLink
        v-for="item in [...FEATURED_PRODUCTS.data].splice(4, 6)"
        :key="item.id"
        :to="`/products/${item.slug}/${item.id}`"
        class="relative group col-span-2"
      >
        <div
          class="
            absolute
            top-0
            left-0
            p-3
            h-full
            w-full
            text-lg text-brown
            bg-black bg-opacity-0
            group-hover:bg-opacity-40
            flex
            items-center
            justify-center
          "
        >
          <p
            style="max-width: 12.5rem"
            class="
              font-bold
              text-xl text-center text-white
              hidden
              group-hover:block
              font-serif
            "
          >
            {{ item.name }}
          </p>
        </div>
        <ContainedImage
          :src="item.images[0].original_image"
          width="960"
          height="600"
        />
      </NuxtLink>
    </div>

    <div class="container mx-auto mb-20 xl:px-10">
      <h2 class="text-3xl font-bold text-primary text-center mb-16 font-serif">
        Most Gifted
      </h2>
      <div
        v-if="!$fetchState.pending"
        class="
          grid grid-cols-1
          sm:grid-cols-2
          md:grid-cols-4
          xl:grid-cols-4
          gap-x-10 gap-y-5
        "
      >
        <div
          v-for="product in MOST_GIFTED_PRODUCTS.data"
          :key="product.id"
          class="flex flex-col items-center text-primary"
        >
          <NuxtLink
            :to="`/products/${product.slug}/${product.id}`"
            class="text-center group"
          >
            <ContainedImage
              :src="product.images[0].thumbnail_image"
              width="335"
              height="335"
              class="
                mb-4
                transition
                rounded
                filter
                scale-95
                group-hover:scale-100 group-hover:drop-shadow-xl
              "
            />
            <p class="mb-2 font-serif">{{ product.name }}</p>
            <strong>{{ $currencyFormat(getMinPrice(product.sizes)) }}</strong>
          </NuxtLink>
        </div>
      </div>
    </div>

    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-primary text-center mb-16 font-serif">
        What People Say
      </h2>
      <div class="h-96">
        <HomeTestimoniesCarousel />
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
import { mapGetters, mapActions } from 'vuex'

export default {
  async fetch() {
    await this.GET_MOST_GIFTED_PRODUCTS()
    await this.GET_FEATURED_PRODUCTS()
    console.log(this.FEATURED_PRODUCTS)
  },
  computed: {
    ...mapGetters({
      MOST_GIFTED_PRODUCTS: 'home/MOST_GIFTED_PRODUCTS',
      FEATURED_PRODUCTS: 'home/FEATURED_PRODUCTS',
    }),
  },
  methods: {
    ...mapActions({
      GET_MOST_GIFTED_PRODUCTS: 'home/GET_MOST_GIFTED_PRODUCTS',
      GET_FEATURED_PRODUCTS: 'home/GET_FEATURED_PRODUCTS',
    }),
    getMinPrice(sizes) {
      const { price } = sizes.reduce((prev, curr) =>
        prev.price < curr.price ? prev : curr
      )
      return price
    },
  },
}
</script>
