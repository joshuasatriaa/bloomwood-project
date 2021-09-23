<template>
  <div class="input-field relative">
    <textarea
      :id="id"
      v-bind="$attrs"
      ref="formTextArea"
      :type="type"
      :value="value"
      :required="required"
      class="
        w-full
        border-primary border-2
        focus:outline-none
        p-4
        placeholder-secondary
        c-input
        ring-brown
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
    type: {
      type: String,
      default: 'text',
    },
    required: {
      type: Boolean,
      default: true,
    },
    classes: {
      type: String,
      default: '',
      required: false,
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
