<template>
  <div
    class="input-field relative"
    :class="{ '-translate-y-7': variant === 'underlined' }"
  >
    <select
      :id="id"
      v-bind="$attrs"
      ref="formSelect"
      placeholder="test"
      :value="value"
      required
      class="w-full bg-transparent border-primary focus:outline-none"
      :class="{
        'mt-5 border-b-4': variant === 'underlined',
        'border rounded-sm': variant === 'outlined',
        'h-9': height === 'default',
        'h-8': height === 'short',
        'text-sm': fontSize === 'small',
      }"
      @input="onInput($event)"
    >
      <!-- <option selected value="" disabled>{{ description }}</option> -->
      <option v-for="option in options" :key="option.id" :value="option.value">
        {{ option.value }}
      </option>
    </select>
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
      :class="{
        ' -translate-y-5': value !== '',
        hidden: variant === 'outlined',
      }"
    >
      {{ label }}
    </label>
  </div>
</template>
<script>
export default {
  name: 'InputSelect',
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
    options: {
      type: Array,
      required: true,
    },
    variant: {
      type: String,
      default: 'underlined',
      validator(value) {
        return ['underlined', 'outlined'].includes(value)
      },
    },
    height: {
      type: String,
      default: 'default',
      validator(value) {
        return ['short', 'default'].includes(value)
      },
    },
    fontSize: {
      type: String,
      default: 'default',
      validator(value) {
        return ['small', 'default'].includes(value)
      },
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
</style>
