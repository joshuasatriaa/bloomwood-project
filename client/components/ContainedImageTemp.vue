<!-- Display image with aspect ratio -->
<!-- To use this component please provide additional width and height ratio in tailwind.config.js -->
<template>
  <div :class="getAspect()">
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
  methods: {
    getAspect() {
      return `aspect-w-${this.width} aspect-h-${this.height}`
    },
  },
}
</script>
<style></style>
