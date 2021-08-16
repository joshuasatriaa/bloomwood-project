<template>
  <div class="mb-3">
    <label :for="formFor" class="form-label">{{ label }}</label>
    <select
      v-bind="$attrs"
      ref="formSelect"
      class="form-select"
      :value="value"
      required
      @input="onInput($event)"
    >
      <option selected value="" disabled>{{ description }}</option>
      <option v-for="option in options" :key="option.id" :value="option.value">
        {{ option.label }}
      </option>
    </select>
    <p v-if="error" class="mt-2 text-danger">
      {{ error }}
    </p>
  </div>
</template>

<script>
export default {
  name: 'FormSelect',
  props: {
    label: {
      type: String,
      default: '',
    },
    formFor: {
      type: String,
      default: '',
    },
    description: {
      type: String,
      default: 'Mohon pilih satu opsi',
    },
    value: {
      type: String,
      default: '',
    },
    options: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      error: '',
    }
  },
  mounted() {
    this.$refs.formSelect.addEventListener('invalid', this.onInvalid)
  },
  beforeDestroy() {
    this.$refs.formSelect.removeEventListener('invalid', this.onInvalid)
  },
  methods: {
    onInput(event) {
      this.$emit('input', event.target.value)
      this.error = ''
    },
    onInvalid(e) {
      this.error = e.target.validationMessage
    },
  },
}
</script>
