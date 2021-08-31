<template>
  <div class="flex text-primary text-sm">
    <button
      v-for="button in buttons"
      :key="button.id"
      type="button"
      class="
        border-2
        px-3
        py-2
        font-bold
        rounded
        mx-4
        first:ml-0
        last:mr-0
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
