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
    </br>
    <button type="button" @click="payment">payyyy</button>
  </div>
</template>

<script>
export default {
  head() {
    return {
      script: [
        {
          type: 'text/javascript',
          src: 'https://app.sandbox.midtrans.com/snap/snap.js',
          'data-client-key': process.env.MIDTRANS_CLIENT_KEY || null,
        },
      ],
    }
  },
  methods: {
    openModal() {
      this.$modal.show('modal-contact-us')
    },
    async payment() {
      const res = await this.$axios.$post('/api/invoices', {
        notes: 'hello',
        address: 'Jln. test',
        address_area_id: '613506f743681d0851495d56',
        pick_up: false,
        products: [
          {
            id: '613506f843681d0851495f73',
            variant_id: '613506f843681d0851495f74',
            add_ons: [
              {
                id: '613506f943681d0851495f76',
              },
            ],
          },
        ],
      }).then((res) => {
        window.snap.pay(res.data.payment_token)
      })
    },
  },
  
}
</script>
