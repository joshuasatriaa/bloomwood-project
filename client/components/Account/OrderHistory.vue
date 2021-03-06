<template>
  <div class="text-primary font-bold">
    <h2 class="text-3xl mb-10">My Order History</h2>
    <div v-if="!$fetchState.pending" class="grid grid-cols-1 gap-y-4">
      <template v-if="ORDER_HISTORY.data.length > 0">
        <div
          v-for="history in ORDER_HISTORY.data"
          :key="history.id"
          class="
            bg-tertiary
            rounded-xl
            p-3
            sm:py-8 sm:px-14
            w-full
            text-primary
            font-bold
          "
        >
          <p class="font-bold mb-3">17 August 2021</p>
          <div class="flex justify-between flex-col xl:flex-row">
            <div class="flex flex-col gap-y-3">
              <div
                v-for="(product, idx) in history.products_detail"
                :key="`${product.id + idx}`"
                class="flex"
              >
                <ContainedImage
                  src="/flower-2.jpg"
                  width="148"
                  height="148"
                  class="
                    rounded-lg
                    border-4 border-primary
                    w-[120px]
                    h-[120px]
                    mr-4
                    mb-3
                    sm:mb-0
                  "
                />
                <div class="flex flex-col">
                  <h2
                    class="
                      font-bold font-serif
                      text-lg
                      2xl:text-xl
                      mb-2
                      max-w-[26ch]
                      line-clamp-2
                    "
                  >
                    {{ product.name }}
                  </h2>

                  <span v-if="product.add_ons.length > 0" class="font-normal"
                    >Add Ons:
                    {{ product.add_ons.map(({ name }) => name).join(', ') }}
                  </span>
                  <span class="font-normal">
                    Size: {{ product.size.name }}
                  </span>
                  <span v-if="product.variant.name" class="font-normal">
                    Variant: {{ product.variant.name }}
                  </span>
                </div>
              </div>
            </div>
            <div
              class="flex xl:flex-col justify-between xl:justify-end items-end"
            >
              <div class="text-center xl:mb-5 order-2 xl:order-1">
                <button
                  v-if="getStatus(history.status).isPayable"
                  class="pb-1 border-b border-brown text-center mb-3 font-bold"
                  @click="() => payNow(history.payment_token)"
                >
                  pay now
                </button>
                <div
                  class="
                    min-w-[6rem]
                    sm:min-w-[10rem]
                    py-2
                    text-center text-white
                    rounded-md
                    text-base
                    sm:text-lg
                  "
                  :class="getStatus(history.status).class"
                >
                  {{ history.status }}
                </div>
              </div>
              <div class="font-bold text-lg sm:text-2xl xl:order-2">
                {{ $currencyFormat(history.grand_total) }}
              </div>
            </div>
          </div>
        </div>
      </template>
      <template v-else>
        <p>there is no purchase history</p>
        <ContainedImage
          src="/empty-cart.svg"
          alt="emptry history illustration"
          width="425"
          height="333"
          class="max-w-xl mt-16"
        />
      </template>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'AccountOrderHistory',
  async fetch() {
    await this.GET_ORDER_HISTORY()
  },
  // head() {
  //   return {
  //     script: [
  //       {
  //         type: 'text/javascript',
  //         src: 'https://app.sandbox.midtrans.com/snap/snap.js',
  //         'data-client-key': process.env.MIDTRANS_CLIENT_KEY || null,
  //       },
  //     ],
  //   }
  // },
  computed: {
    ...mapGetters({
      ORDER_HISTORY: 'invoices/ORDER_HISTORY',
    }),
  },
  methods: {
    ...mapActions({
      GET_ORDER_HISTORY: 'invoices/GET_ORDER_HISTORY',
    }),
    payNow(token) {
      window.snap.pay(token)
    },
    getStatus(status) {
      switch (status) {
        case 'capture':
        case 'settlement':
          return { isPayable: false, class: 'bg-success' }
        case 'pending':
          return { isPayable: true, class: 'bg-warn' }
        case 'deny':
        case 'cancel':
        case 'expire':
          return { isPayable: false, class: 'bg-red-400' }
        case 'refund':
        case 'partial_refund':
          return { isPayable: false, class: 'bg-blue-400' }
        case 'authorize':
          return { isPayable: false, class: 'bg-grey-400' }
      }
    },
  },
}
</script>
