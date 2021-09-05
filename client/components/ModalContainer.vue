<template>
  <div
    class="
      bg-tertiary
      w-full
      h-full
      flex flex-col
      items-center
      p-2
      text-primary
      justify-center
    "
  >
    <h5 class="text-3xl font-serif mb-3">{{ title }}</h5>
    <p class="font-bold mb-10">{{ desc }}</p>
    <button
      type="button"
      class="w-full py-3 hover:bg-brown text-white font-bold bg-primary rounded"
      style="max-width: 250px"
    >
      {{ btnTitle }}
    </button>
  </div>
</template>
<script>
export default {
  name: 'ModalContainer',
  props: {
    title: {
      type: String,
      required: true,
    },
    desc: {
      type: String,
      required: true,
    },
    btnTitle: {
      type: String,
      required: true,
    },
  },
}
</script>
<style>
.vm--modal {
  @apply bg-tertiary;
}
</style>
