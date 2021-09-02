<template>
  <div class="input-field relative -translate-y-7">
    <select
      :id="id"
      v-bind="$attrs"
      ref="formSelect"
      placeholder="test"
      :value="value"
      required
      class="
        mt-5
        h-9
        w-full
        bg-transparent
        border-primary border-b-4
        focus:outline-none
      "
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
      :class="{ ' -translate-y-5': value !== '' }"
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
