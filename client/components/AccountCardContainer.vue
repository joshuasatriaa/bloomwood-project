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
      <h1 class="text-3xl text-center mb-4">{{ title }}</h1>
      <p class="font-bold text-center mb-16">{{ description }}</p>
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
  },
}
</script>
