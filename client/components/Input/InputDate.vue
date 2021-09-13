<template>
  <div class="relative">
    <label
      v-if="label"
      :for="id"
      class="
        transition
        transform
        duration-800
        cursor-text
        ease-in-out
        bg-transparent
        text-secondary
        font-bold
      "
    >
      {{ label }}
    </label>
    <input
      :id="id"
      ref="formDate"
      type="date"
      v-bind="$attrs"
      :value="value"
      required
      :placeholder="placeholder"
      class="
        w-full
        border-primary border-2
        focus:outline-none
        px-3
        py-2
        placeholder-secondary
        font-bold
        text-secondary
      "
      :class="classes"
      @input="onInput($event)"
    />
  </div>
</template>
<script>
export default {
  name: 'InputTextArea',
  props: {
    id: {
      type: String,
      required: true,
    },
    value: {
      type: String,
      default: '',
    },
    classes: {
      type: String,
      default: '',
      required: false,
    },
    placeholder: {
      type: String,
      required: true,
    },
    label: {
      type: [String, Boolean],
      required: false,
      default: false,
    },
  },
  methods: {
    onInput(event) {
      this.$emit('input', event.target.value)
    },
  },
}
</script>
<style></style>
