<template>
  <modal
    :name="id"
    :adaptive="true"
    width="90%"
    :max-width="670"
    classes="p-2 bg-tertiary rounded-xl text-primary flex flex-col items-center justify-center"
  >
    <h5 class="text-3xl font-serif" :class="[desc ? 'mb-3' : 'mb-10']">
      {{ title }}
    </h5>
    <p v-if="desc" class="font-bold mb-10">{{ desc }}</p>
    <div class="flex w-full justify-center gap-x-2">
      <button
        v-if="btnCloseTitle"
        type="button"
        class="
          w-full
          py-3
          hover:bg-brown
          text-white
          font-bold
          bg-primary
          rounded
        "
        style="max-width: 250px"
        @click="$modal.hide(id)"
      >
        {{ btnCloseTitle }}
      </button>
      <button
        v-if="btnProceedTitle && btnProceedCallback"
        type="button"
        class="
          w-full
          py-3
          hover:bg-brown
          text-white
          font-bold
          bg-primary
          rounded
        "
        style="max-width: 250px"
        @click="btnProceedCallback"
      >
        {{ btnProceedTitle }}
      </button>
    </div>
  </modal>
</template>
<script>
export default {
  name: 'ModalContainer',
  props: {
    id: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
    desc: {
      type: [String, Boolean],
      required: false,
      default: false,
    },
    btnCloseTitle: {
      type: [String, Boolean],
      required: false,
      default: false,
    },
    btnProceedTitle: {
      type: [String, Boolean],
      required: false,
      default: false,
    },
    btnProceedCallback: {
      type: [Function, Boolean],
      required: false,
      default: () => alert('proceed button clicked'),
    },
  },
  methods: {
    closeModal() {
      this.$modal.hide(this.id)
    },
  },
}
</script>
<style>
.vm--modal {
  @apply bg-tertiary;
}
</style>
