<template>
  <div
    class="container mx-auto flex h-10 items-center justify-between font-serif"
  >
    <div class="flex items-center">
      <span class="font-bold text-secondary mr-5 hidden sm:block"
        >Connect with us</span
      >
      <IconInstagram class="fill-current text-dark-icon mr-5" />
      <IconFacebook class="fill-current text-dark-icon mr-5" />
      <IconBrideStory class="fill-current text-primary mr-5" />
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
        <span
          to="/account"
          class="text-secondary group-hover:text-primary transition-colors"
          >Account</span
        >
        <div
          v-if="!$auth.user"
          class="
            hidden
            group-hover:flex
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
            text-primary
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
          2
        </div>
      </NuxtLink>
    </div>
  </div>
</template>
<script>
export default {
  name: 'NavHeader',
}
</script>
