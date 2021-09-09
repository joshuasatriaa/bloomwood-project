<template>
  <div>
    invoices
    <button class="btn btn-primary" @click="testSend()">Test invoice</button>
  </div>
</template>

<script>
export default {
  middleware: 'auth',
  methods: {
    async testSend() {
      const res = await this.$axios.$post('/api/invoices', {
        notes: 'test notes',
        address: 'test address',
        address_area_id: '6128c9b2d1ed38447c1ae7f6',
        pick_up: 0,
        products: [
          {
            id: '6128c9b6d1ed38447c1aea34',
            variant_id: '6128c9b6d1ed38447c1aea35',
            add_ons: [
              {
                id: '6128c9b6d1ed38447c1aea36',
              },
            ],
          },
        ],
      })

      console.log(res)
    },
  },
}
</script>

<style></style>
