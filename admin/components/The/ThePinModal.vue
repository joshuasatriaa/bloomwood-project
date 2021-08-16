<template>
  <div>
    <button
      type="button"
      class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#pinModal"
    >
      Masukkan PIN Anda
    </button>

    <!-- Modal -->
    <div
      id="pinModal"
      class="modal fade"
      tabindex="-1"
      aria-labelledby="pinModalLabel"
      aria-hidden="true"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <h5 id="pinModalLabel" class="modal-title">Masukkan PIN Anda</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="reset()"
            ></button>
          </div>
          <div class="modal-body">
            <div class="col-12 col-lg-10 mx-auto">
              <BaseInput
                v-model="pin"
                type="password"
                placeholder="PIN"
                form-for="formPin"
                label="PIN"
                required
              />
              <p class="my-2 text-danger text-small">
                PIN merupakan 6 digit angka.
              </p>
              <small class="text-muted"
                >Aksi ini membutuhkan verifikasi PIN Anda.</small
              >
            </div>
          </div>
          <div class="modal-footer border-0">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              @click="reset(true)"
            >
              Batal
            </button>
            <button
              type="button"
              class="btn btn-primary"
              data-bs-dismiss="modal"
              :class="{ disabled: isDisable }"
              :disable="isDisable"
              @click="
                mutatePin()
                reset(false)
              "
            >
              Simpan
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ThePinModal',
  data() {
    return {
      pin: '',
    }
  },
  computed: {
    isDisable() {
      return this.pin.length < 6
    },
  },
  watch: {
    pin() {
      const maxLength = 6
      if (isNaN(this.pin)) {
        this.pin = ''
        this.$toast.clear()
        this.$errorHandler('Mohon masukkan angka saja.', {
          timeout: 2000,
        })
      }

      if (this.pin.length > maxLength) {
        this.pin = this.pin.substring(0, maxLength)
      }
    },
  },
  methods: {
    mutatePin() {
      this.$store.commit('pinModal/SET_PIN', this.pin)
    },
    reset(mutate = true) {
      this.pin = ''
      if (mutate) {
        this.$store.commit('pinModal/RESET_PIN')
      }
    },
  },
}
</script>

<style></style>
