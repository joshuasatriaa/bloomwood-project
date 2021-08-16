<template>
  <div class="form-check mx-2">
    <input
      :id="formFor"
      class="form-check-input"
      type="checkbox"
      :checked="value"
      @change="onChange($event)"
    />

    <label class="form-check-label" :for="formFor">{{ label }}</label>
  </div>
</template>

<script>
export default {
  name: 'BaseCheckbox',

  props: {
    value: {
      type: Boolean,
      default: false,
    },
    label: {
      type: String,
      required: true,
      default: '',
    },
    formFor: {
      type: String,
      default: '',
    },
  },
  methods: {
    onChange(event) {
      this.$emit('input', event.target.checked)
    },
  },
}
</script>

<style></style>
