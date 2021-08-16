<template>
  <div :class="{ 'mb-3': withMargin }">
    <label v-if="label" :for="formFor" class="form-label">{{ label }}</label>
    <input
      v-if="controlType === 'input'"
      v-bind="$attrs"
      ref="formInput"
      class="form-control"
      :type="type"
      :value="value"
      required
      @input="onInput($event)"
    />
    <p v-if="error" class="mt-2 text-danger">
      {{ error }} <span v-if="example">(e.g. {{ example }})</span>
    </p>
  </div>
</template>

<script>
export default {
  name: 'FormInput',
  props: {
    withMargin: {
      type: Boolean,
      required: false,
      default: true,
    },
    formFor: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: false,
      default: '',
    },
    controlType: {
      type: String,
      default: 'input',
    },
    value: {
      type: String,
      default: '',
    },
    type: {
      type: String,
      default: 'text',
    },
    example: {
      type: String,
      required: false,
      default: '',
    },
  },
  data() {
    return {
      error: null,
    }
  },
  mounted() {
    this.$refs.formInput.addEventListener('invalid', this.onInvalid)
  },
  beforeDestroy() {
    this.$refs.formInput.removeEventListener('invalid', this.onInvalid)
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

<style></style>
