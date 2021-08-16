<template>
  <h5>
    <span class="badge" :class="getBadge().class">{{ getBadge().label }}</span>
  </h5>
</template>

<script>
export default {
  name: 'UsersBadge',
  props: {
    boolean: {
      type: Boolean,
      required: true,
      default: false,
    },
    trueLabel: {
      type: String,
      default: 'Aktif',
    },
    falseLabel: {
      type: String,
      default: 'Tidak Aktif',
    },
    trueClass: {
      type: String,
      default: 'bg-success',
    },
    falseClass: {
      type: String,
      default: 'bg-danger',
    },
  },
  methods: {
    getBadge() {
      const res = {}
      if (this.boolean) {
        res.class = this.trueClass
        res.label = this.trueLabel
        return res
      }

      res.class = this.falseClass
      res.label = this.falseLabel
      return res
    },
  },
}
</script>

<style></style>
