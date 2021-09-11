<template>
  <div class="table-responsive">
    <table v-if="invoices.data" class="table table-striped table-hover">
      <thead class="">
        <tr>
          <th scope="col">Number</th>
          <th scope="col">User</th>
          <th scope="col">Grand Total</th>
          <th scope="col">Pick Up</th>
          <th scope="col">Created At</th>
          <th scope="col">Status</th>
          <th scope="col" class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="invoice in invoices.data" :key="invoice.id">
          <td class="text-nowrap text-truncate">
            {{ invoice.invoice_number }}
          </td>
          <td>{{ invoice.user.name }}</td>
          <td>
            {{ $currencyFormat(invoice.grand_total) }}
          </td>
          <td>{{ invoice.pick_up ? 'Yes' : 'No' }}</td>
          <td class="text-nowrap">
            {{ invoice.created_at_format }}
          </td>
          <td class="text-uppercase">
            <p class="m-0">
              <span class="badge" :class="getStatusColor(invoice.status)">
                {{ invoice.status }}
              </span>
            </p>
          </td>
          <td class="text-end text-nowrap">
            <NuxtLink :to="`/invoices/${invoice.id}`" class="btn btn-primary"
              >Details</NuxtLink
            >
          </td>
        </tr>
        <tr v-if="!invoices.data.length">
          <td colspan="6" class="text-center">
            <span class="text-danger fw-bold">Data not found.</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'InvoicesTable',
  props: {
    invoices: {
      type: Object,
      default: () => {},
    },
  },
  setup() {
    const getStatusColor = (status) => {
      switch (status) {
        case 'pending':
          return 'bg-warning'
      }
    }

    return { getStatusColor }
  },
}
</script>

<style scoped>
th,
td {
  vertical-align: baseline !important;
}
</style>
