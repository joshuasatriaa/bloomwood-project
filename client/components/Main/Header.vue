<template>
  <div class="container mx-auto flex h-10 items-center justify-between">
    <div class="flex items-center">
      <span class="font-bold text-secondary mr-5 hidden sm:block"
        >Connect with us</span
      >
      <IconInstagram class="mr-5" />
      <IconFacebook class="mr-5" />
      <IconBrideStory class="mr-5" />
    </div>
    <div class="h-full flex">
      <div
        class="
          h-full
          flex
          items-center
          px-3
          sm:px-5
          border-soft-gray border-l border-r
        "
      >
        <IconAccount class="mr-5" />
        <span class="text-secondary">Account</span>
      </div>
      <div class="h-full flex items-center px-3 sm:px-5">
        <IconCart class="mr-3" />
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
          "
        >
          2
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {}
</script>
