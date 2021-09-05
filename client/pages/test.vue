<template>
  <div>
    <modal name="example">
      <ModalContainer title="Thank you" desc="our team will contact you soon" />
    </modal>
    <button type="button" @click="openModal">open modal</button>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$modal.show('example')
  },
  methods: {
    openModal() {
      this.$modal.show('example')
    },
  },
}
</script>
