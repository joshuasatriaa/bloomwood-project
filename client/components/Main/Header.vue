<template>
  <div
    class="container mx-auto flex h-10 items-center justify-between font-serif"
  >
    <div class="flex items-center">
      <span class="font-bold text-secondary mr-5 hidden sm:block"
        >Connect with us</span
      >
      <a
        href="https://www.instagram.com/bloomwoodflorist"
        rel="noopener noreferrer"
        target="_blank"
      >
        <IconInstagram class="fill-current text-dark-icon mr-5" />
      </a>
      <a
        href="https://www.facebook.com/BloomwoodFlorist/"
        rel="noopener noreferrer"
        target="_blank"
      >
        <IconFacebook class="fill-current text-dark-icon mr-5" />
      </a>

      <a
        href="https://www.tokopedia.com/bloomwoodflorist"
        rel="noopener noreferrer"
        target="_blank"
      >
        <ContainedImage
          src="/tokopedia_icon.png"
          width="22"
          height="22"
          class="mr-5"
        />
      </a>
    </div>
    <div class="h-full flex divide-x">
      <NuxtLink
        to="/account"
        class="
          group
          h-full
          flex
          items-center
          px-3
          sm:px-5
          border-soft-gray border-l
          relative
        "
        tag="button"
        :disabled="!$auth.user"
      >
        <IconAccount
          class="
            mr-3
            fill-current
            text-secondary
            group-hover:text-primary
            transition-colors
          "
        />
        <span class="text-secondary group-hover:text-primary transition-colors"
          >Account</span
        >
        <div
          v-if="!$auth.user"
          class="
            hidden
            group-hover:flex
            group-focus:flex
            flex-col
            absolute
            min-w-full
            bg-white
            border
            inset-x-0
            top-full
            z-20
            min-h-full
            py-2
            text-primary text-center
          "
        >
          <NuxtLink to="/accounts/login" class="mb-3">Login</NuxtLink>
          <NuxtLink to="/accounts/register">Sign Up</NuxtLink>
        </div>
      </NuxtLink>
      <NuxtLink to="/cart" class="h-full flex items-center px-3 sm:px-5 group">
        <IconCart
          class="mr-3 fill-current text-secondary group-hover:text-primary"
        />
        <div
          class="
            rounded-full
            h-5
            w-5
            flex
            items-center
            justify-center
            bg-pink
            text-xs text-white
            group-hover:bg-red-400
          "
        >
          {{ CART_COUNT }}
        </div>
      </NuxtLink>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'NavHeader',
  computed: {
    ...mapGetters({
      CART_COUNT: 'CART_COUNT',
    }),
  },
  mounted() {
    this.GET_CART_COUNT()
  },
  methods: {
    ...mapActions({
      GET_CART_COUNT: 'GET_CART_COUNT',
    }),
  },
}
</script>
