<template>
  <div
    class="relative"
    :class="[
      { '-translate-y-7': variant === 'underlined' },
      variant === 'outlined'
        ? 'input-field-outlined'
        : 'input-field-underlined',
    ]"
  >
    <select
      :id="id"
      v-bind="$attrs"
      ref="formSelect"
      placeholder=" "
      :value="value"
      required
      class="w-full focus:outline-none ring-0 pl-0 pr-4 py-1"
      :class="[
        {
          'mt-5 border-t-0 border-l-0 border-r-0 border-b-4':
            variant === 'underlined',
          'border-2 rounded-sm pl-2': variant === 'outlined',
          'h-10': height === 'default',
          'h-8': height === 'short',
          'text-sm': fontSize === 'small',
        },
        borderColor === 'dark' ? 'border-primary' : 'border-secondary',
        getBackgroundColor,
      ]"
      @input="onInput($event)"
    >
      <option selected value=""></option>
      <option v-for="option in options" :key="option.id" :value="option.value">
        {{ option.label || option.value }}
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
        absolute
        bg-transparent
        text-secondary
        font-bold
      "
      :class="[
        {
          '-translate-y-5': value !== '' && variant === 'underlined',
          '-translate-y-8 translate-x-0':
            value !== '' && variant === 'outlined',
        },
        variant !== 'outlined' ? 'bottom-3' : 'bottom-2',
      ]"
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
    placeholder: {
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
    backgroundColor: {
      type: String,
      default: 'transparent',
    },
    borderColor: {
      type: String,
      default: 'dark',
      validator(value) {
        return ['dark', 'light'].includes(value)
      },
    },
  },
  computed: {
    getBackgroundColor() {
      return `bg-${this.backgroundColor}`
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
.input-field-underlined:focus-within label {
  @apply -translate-y-5;
}
.input-field-outlined:focus-within label {
  @apply -translate-y-8;
  @apply translate-x-0;
}

.input-field-outlined:not(:focus-within) label {
  @apply translate-x-5;
}
</style>
