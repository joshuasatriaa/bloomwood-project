<template>
  <div class="input-field relative -translate-y-7">
    <input
      :id="id"
      v-bind="$attrs"
      ref="formInput"
      placeholder=" "
      :type="type"
      :value="value"
      required
      class="
        mt-5
        h-9
        w-full
        bg-transparent
        border-primary border-b-4 border-blue
        focus:outline-none
      "
      @input="onInput($event)"
    />
    <label
      :for="id"
      class="
        transition
        transform
        duration-800
        cursor-text
        ease-in-out
        left-0
        bottom-3
        absolute
        bg-transparent
        text-secondary
        font-bold
      "
    >
      {{ label }}
    </label>
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
