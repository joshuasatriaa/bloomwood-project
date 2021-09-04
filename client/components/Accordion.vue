<template>
  <div class="border-2 border-primary rounded px-5">
    <button class="flex justify-between h-14 items-center w-full" type="button">
      <p class="font-bold text-lg">test</p>
      <IconCaretUp class="transform -rotate-180" />
    </button>
    <div>
      <slot />
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isOpen: false,
    }
  },
}
</script>
<style></style>
