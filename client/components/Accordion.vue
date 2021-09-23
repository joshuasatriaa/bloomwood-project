<template>
  <div class="rounded">
    <button
      class="
        flex
        justify-between
        h-14
        items-center
        w-full
        px-5
        border-t-2 border-l-2 border-r-2
        rounded-t
        border-primary
      "
      :class="{ 'border-b-2 rounded-b': !isOpen }"
      type="button"
      @click="() => (isOpen = !isOpen)"
    >
      <p class="font-bold text-lg">{{ title }}</p>
      <IconCaretUp
        class="transform transition-transform"
        :class="{ '-rotate-180': !isOpen }"
      />
    </button>
    <div
      class="
        px-5
        transition-all
        origin-top
        border-b-2 border-l-2 border-r-2 border-primary
        rounded-b
        py-4
      "
      :class="{
        'h-0 scale-y-0': !isOpen,
        'scale-y-100': isOpen,
      }"
    >
      <slot />
    </div>
  </div>
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    defaultOpen: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      isOpen: this.defaultOpen,
    }
  },
}
</script>
<style></style>
