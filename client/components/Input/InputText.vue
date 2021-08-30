<template>
  <div className="relative h-10 mt-5 mb-10">
    <label
      htmlFor="password"
      class="
        transition
        transform
        duration-800
        ease-in-out
        left-2
        bottom-0
        absolute
        text-primary
        px-1
      "
      :class="`${styling}`"
    >
      {{ label }}
    </label>
    <input
      v-bind="$attrs"
      ref="formInput"
      :type="type"
      :value="value"
      required
      class="
        mt-5
        h-full
        w-full
        bg-white
        border-gray-300 border-2
        px-2
        border-blue
        rounded-md
        focus:outline-none
        focus:ring-1
        focus:ring-gray-800
        focus:border-transparent
      "
      @focus="() => setIsFocused(true)"
      @blur="() => setIsFocused(false)"
      @input="onInput($event)"
    />
  </div>
</template>
<script>
export default {
  props: {
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
    height: {
      type: String,
      required: false,
      default: '',
    },
    example: {
      type: String,
      required: false,
      default: '',
    },
  },
  data() {
    return {
      isFocusedStyle: '',
      isFocuced: false,
    }
  },
  computed: {
    styling() {
      return this.value || this.isFocused ? '-translate-y-7 -translate-x-2' : ''
    },
  },
  methods: {
    setIsFocused(boolVal) {
      console.log('jalan', boolVal)
      this.isFocused = boolVal
    },
    onInput(event) {
      this.$emit('input', event.target.value)
      this.error = ''
    },
  },
}
</script>
<style></style>
