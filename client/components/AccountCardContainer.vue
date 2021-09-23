<template>
  <div class="flex justify-center items-center">
    <div
      class="
        bg-tertiary
        w-full
        mx-2
        sm:w-11/12 sm:mx-0 sm:px-16
        md:w-8/12
        lg:w-6/12
        xl:w-5/12
        rounded-xl
        py-10
        px-5
      "
    >
      <h1
        class="text-3xl text-center font-serif"
        :class="[marginType === 'default' ? 'mb-4' : 'mt-10 mb-8']"
      >
        {{ title }}
      </h1>
      <p
        class="font-bold text-center"
        :class="[marginType === 'default' ? 'mb-16' : 'mb-10']"
      >
        {{ description }}
      </p>
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
    description: {
      type: String,
      required: true,
    },
    marginType: {
      type: String,
      default: 'default',
      validator(value) {
        return ['default', 'compact'].includes(value)
      },
    },
  },
}
</script>
