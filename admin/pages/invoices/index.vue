<template>
  <div class="container">
    <h1 class="mb-4">Invoices</h1>
    <div class="row">
      <div class="col text-end">
        <button class="btn btn-primary text-white mb-4" @click="testSend()">
          Test invoice
        </button>
      </div>
    </div>
    <BaseSearch :callback="getInvoices" />
    <InvoicesTable v-if="invoices" :invoices="invoices" />
    <div class="col-12 col-md-6 d-flex justify-content-end ms-auto">
      <BasePagination
        getter="invoices/INVOICES"
        action="invoices/GET_INVOICES"
      />
    </div>
  </div>
</template>

<script>
import { useGetInvoices } from '@/composables/useInvoices'
export default {
  middleware: 'auth',
  setup() {
    const { invoices, getInvoices } = useGetInvoices()
    return { invoices, getInvoices }
  },
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
