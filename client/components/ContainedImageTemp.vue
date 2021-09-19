<template>
  <div class="aspect-w-398 aspect-h-499">
    <img
      :src="src"
      alt="..."
      class="w-full h-full object-center object-cover"
    />
  </div>
</template>
<script>
export default {
  name: 'ContainedImageTemp',
  props: {
    src: {
      type: String,
      required: true,
    },
    isLocalUrl: {
      type: Boolean,
      default: true,
    },
    width: {
      type: [String, Number],
      required: false,
      default: 1903,
    },
    height: {
      type: [String, Number],
      required: false,
      default: 761,
    },
    isFluid: {
      type: Boolean,
      required: false,
      default: true,
    },
  },
}
</script>
<style></style>
