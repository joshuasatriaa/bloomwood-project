<template>
  <img
    :src="getImgUrl()"
    :class="{ 'w-full h-auto': isFluid }"
    :style="{
      aspectRatio: `${width}/${height}`,
    }"
    class="object-cover object-center"
    :width="width"
    :height="height"
    v-bind="$attrs"
  />
</template>

<script>
export default {
  name: 'ContainedImage',
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
    getImgUrl() {
      if (this.isLocalUrl) {
        return this.src
      }
      return this.$getFullImageUrl(this.src)
    },
  },
}
</script>
