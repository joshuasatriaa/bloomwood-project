<template>
  <div class="input-field relative">
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
        px-4
        py-2
        placeholder-secondary
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
  },
  methods: {
    onInput(event) {
      this.$emit('input', event.target.value)
    },
  },
}
</script>
<style>
.input-field:focus-within label {
  @apply -translate-y-5;
}

.c-input:not(:placeholder-shown) ~ label {
  @apply -translate-y-5;
}
</style>
