<template>
  <div class="input-field relative">
    <textarea
      :id="id"
      v-bind="$attrs"
      ref="formInput"
      placeholder=" "
      :type="type"
      :value="value"
      required
      class="w-full bg-transparent border-primary border-2 focus:outline-none"
      @input="onInput($event)"
    />
  </div>
</template>
<script>
export default {
  props: {
    id: {
      type: String,
      required: true,
    },
    label: {
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

input:not(:placeholder-shown) ~ label {
  @apply -translate-y-5;
}
</style>
