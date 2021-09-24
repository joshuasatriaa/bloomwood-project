<template>
  <!-- <img
    :src="getImgUrl()"
    :class="{ 'w-full h-auto': isFluid }"
    :style="{
      aspectRatio: `${width}/${height}`,
    }"
    class="object-cover object-center"
    :width="width"
    :height="height"
    v-bind="$attrs"
  /> -->
  <div :class="aspectClass">
    <img
      :src="src"
      class="w-full h-full object-center object-cover"
      :class="`${imageClass}`"
      :width="width"
      :height="height"
      v-bind="$attrs"
    />
  </div>
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
      required: true,
    },
    height: {
      type: [String, Number],
      required: true,
    },
    isFluid: {
      type: Boolean,
      required: false,
      default: true,
    },
    aspectClass: {
      type: String,
      required: false,
      default: '',
    },
    imageClass: {
      type: String,
      required: false,
      default: '',
    },
  },
  // computed: {
  //   aspectRatio() {
  //     return `aspect-w-${this.width}`
  //   },
  //   aspectRatio2() {
  //     return ` aspect-h-${this.height}`
  //   },
  // },
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
