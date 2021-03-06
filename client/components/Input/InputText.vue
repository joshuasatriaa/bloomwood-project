<template>
  <div>
    <div
      class="relative"
      :class="[
        { '-translate-y-7': variant === 'underlined' },
        variant === 'outlined'
          ? 'input-field-outlined'
          : 'input-field-underlined',
      ]"
    >
      <input
        :id="id"
        v-bind="$attrs"
        ref="formInput"
        placeholder=" "
        :type="type"
        :value="value"
        required
        class="w-full bg-transparent ring-0 focus:outline-none c-input pl-0"
        :class="[
          {
            'mt-5 border-t-0  border-l-0 border-r-0 border-b-4':
              variant === 'underlined',
            'border-2  rounded-sm pl-3': variant === 'outlined',
            'h-10': height === 'default',
            'h-8': height === 'short',
            'text-sm': fontSize === 'small',
          },
          borderColor === 'dark' ? 'border-primary' : 'border-secondary',
          getBackgroundColor,
        ]"
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
    <template v-if="error">
      <div :class="{ 'absolute -translate-y-6': variant === 'underlined' }">
        <p class="text-red-400 font-bold">
          {{ error[0] }}
        </p>
      </div>
    </template>
  </div>
</template>
<script>
export default {
  name: 'InputText',
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
    height: {
      type: String,
      default: 'default',
      validator(value) {
        return ['short', 'default'].includes(value)
      },
    },
    variant: {
      type: String,
      default: 'underlined',
      validator(value) {
        return ['underlined', 'outlined'].includes(value)
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
    error: {
      type: [Array, Boolean],
      default: false,
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

.c-input:not(:placeholder-shown) ~ label {
  @apply -translate-y-5;
}
</style>
