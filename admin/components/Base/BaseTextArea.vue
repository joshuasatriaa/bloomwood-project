<template>
  <div class="mb-3">
    <label :for="formFor" class="form-label">{{ label }}</label>
    <textarea
      v-if="controlType === 'input'"
      v-bind="$attrs"
      ref="formTextArea"
      class="form-control"
      :type="type"
      :value="value"
      required
      @input="onInput($event)"
    ></textarea>
    <p v-if="error" class="mt-2 text-danger">
      {{ error }} <span v-if="example">(e.g. {{ example }})</span>
    </p>
  </div>
</template>

<script>
export default {
  name: 'FormTextArea',
  props: {
    formFor: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
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
    this.$refs.formTextArea.addEventListener('invalid', this.onInvalid)
  },
  beforeDestroy() {
    this.$refs.formTextArea.removeEventListener('invalid', this.onInvalid)
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
