<template>
  <div>
    <!-- <modal name="example">
      <ModalContainer title="Thank you" desc="our team will contact you soon" />
    </modal> -->
    <button type="button" @click="openModal">open modal</button>
    <ModalContainer
      id="modal-contact-us"
      title="Thank you"
      desc="our team will contact you soon"
      btn-close-title="back to home"
      :btn-callback="$modal.hide('modal-contact-us')"
    />
  </div>
</template>

<script>
export default {
  methods: {
    openModal() {
      this.$modal.show('modal-contact-us')
    },
  },
}
</script>
