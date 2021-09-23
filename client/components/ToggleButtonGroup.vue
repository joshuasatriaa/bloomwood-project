<template>
  <div
    class="
      flex flex-row
      text-primary text-sm
      flex-wrap
      gap-x-3 gap-y-1
      sm:gap-x-4 sm:gap-y-2
    "
  >
    <button
      v-for="button in buttons"
      :key="button.id"
      type="button"
      class="
        border-2
        py-2
        font-bold
        rounded
        transition-transform
        hover:scale-105 hover:border-primary
      "
      style="min-width: 120px"
      :class="[
        button.value !== currentValue
          ? 'border-disabled-dark bg-disabled text-disabled-dark'
          : 'border-primary',
      ]"
      @click="() => $emit('changed', button.value)"
    >
      {{ button.label }}
    </button>
  </div>
</template>
<script>
export default {
  props: {
    buttons: {
      type: Array,
      required: true,
    },
    currentValue: {
      type: [String, Number],
      required: true,
    },
  },
}
</script>
<style></style>
