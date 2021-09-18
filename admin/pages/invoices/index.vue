<template>
  <div class="container">
    <h1 class="mb-4">Invoices</h1>
    <!-- <div class="row">
      <div class="col text-end">
        <button class="btn btn-primary text-white mb-4" @click="testSend()">
          Test invoice
        </button>
      </div>
    </div> -->
    <!-- <BaseSearch :callback="getInvoices" /> -->
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
import { useGetInvoices } from '~/composables/useInvoice'
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
        address_area_id: '613b1aebfc3fb909d97cef45',
        pick_up: 0,
        products: [
          {
            id: '613b1aedfc3fb909d97cf160',
            variant_id: '613b1aedfc3fb909d97cf161',
            size: 'Classic',
            add_ons: [
              {
                id: '613b1aeefc3fb909d97cf163',
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
