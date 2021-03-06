<template>
  <div class="container mx-auto mt-10">
    <h1 class="text-3xl font-normal mb-14 font-serif text-primary">
      Select Delivery Address & Time
    </h1>
    <template v-if="shipment.length < 1">
      <p class="text-red-400 font-bold">
        You haven't selected any items from your cart.
        <NuxtLink to="/cart" class="text-brown underline">Go to cart</NuxtLink>
      </p>
    </template>
    <template v-else>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-4 text-primary">
        <div>
          <template v-for="item in shipment">
            <div
              :key="item.id"
              class="flex gap-x-10 text-sm bg-tertiary rounded-xl mb-3"
            >
              <div
                class="
                  flex flex-col
                  xl:flex-row
                  justify-between
                  gap-y-3
                  p-3
                  lg:p-10
                  w-full
                "
              >
                <div class="flex flex-col gap-y-3 sm:flex-row">
                  <ContainedImage
                    :src="item.productImage"
                    width="148"
                    height="148"
                    class="
                      rounded-lg
                      border-4 border-primary
                      mr-4
                      w-[9.375rem]
                      h-[9.375rem]
                    "
                  />
                  <div class="flex flex-col">
                    <h2
                      class="
                        font-bold font-serif
                        text-lg
                        mb-2
                        max-w-[17ch]
                        line-clamp-2
                      "
                    >
                      {{ item.productName }}
                    </h2>
                    <span>Size: {{ item.size }}</span>
                    <span v-if="item.variant"
                      >Variant: {{ item.variant.name }}</span
                    >
                    <span v-if="item.addOns.length > 0"
                      >Bundle:
                      {{ item.addOns.map(({ name }) => name).join(', ') }}</span
                    >
                    <span></span>
                    <span>Qty: {{ item.qty }}</span>
                  </div>
                </div>
                <div class="font-bold text-right text-lg">
                  {{ $currencyFormat(item.subtotalPrice * item.qty) }}
                </div>
              </div>
            </div>
          </template>
        </div>
        <form
          class="bg-tertiary rounded-xl p-5"
          @submit.prevent="showConfirmModal"
        >
          <h2 class="mb-5 font-bold font-serif text-lg">Select Method</h2>
          <div class="flex min-h-[6rem] gap-x-3 sm:gap-x-6 mb-8">
            <button
              type="button"
              class="
                appearance-none
                flex flex-col
                rounded-lg
                justify-center
                items-center
                border-2 border-primary
                min-w-[7rem]
                sm:min-w-[10rem]
              "
              :class="[
                deliveryMethod === 'delivery' ? 'bg-white' : 'bg-[#D9D5D2]',
              ]"
              @click="handleMethod('delivery')"
            >
              <IconTruck class="fill-current text-primary mb-2" />
              <p class="font-bold text-sm">Delivery</p>
            </button>
            <button
              type="button"
              class="
                flex flex-col
                rounded-lg
                justify-center
                items-center
                border-2 border-primary
                min-w-[7rem]
                sm:min-w-[10rem]
              "
              :class="[
                deliveryMethod === 'pickup' ? 'bg-white' : 'bg-[#D9D5D2]',
              ]"
              @click="handleMethod('pickup')"
            >
              <IconBag class="fill-current text-primary mb-2" />
              <span class="font-bold text-sm">Self Pick Up</span>
            </button>
          </div>

          <template v-if="deliveryMethod === 'delivery'">
            <div class="mb-10 font-serif">
              <div class="flex relative my-4">
                <input
                  id="currentAddress"
                  v-model="addressType"
                  value="currentAddress"
                  name="address"
                  type="radio"
                  class="opacity-0 absolute h-5 w-5 cursor-pointer"
                />
                <div
                  class="
                    bg-white
                    border-2
                    rounded-sm
                    border-primary
                    w-5
                    h-5
                    flex flex-shrink-0
                    justify-center
                    items-center
                    cursor-pointer
                    focus-within:border-blue-500 focus-within:bg-primary
                  "
                >
                  <div
                    class="h-3 w-3 bg-pink rounded-sm"
                    :class="[
                      addressType === 'currentAddress' ? 'block' : 'hidden',
                    ]"
                  ></div>
                </div>
                <label
                  class="font-bold select-none pl-5 cursor cursor-pointer"
                  for="currentAddress"
                >
                  <div class="flex flex-col">
                    <p class="mr-2 font-bold">My Current Address</p>
                    <span class="font-semibold font-sans text-sm">{{
                      `${$auth.user.addresses[0].address} (${$auth.user.addresses[0].address_area.name})`
                    }}</span>
                  </div>
                </label>
              </div>
            </div>

            <div class="mb-10 font-serif">
              <div class="flex relative my-4">
                <input
                  id="customAddress"
                  v-model="addressType"
                  name="address"
                  value="customAddress"
                  type="radio"
                  class="opacity-0 absolute h-5 w-5 cursor-pointer"
                />
                <div
                  class="
                    bg-white
                    border-2
                    rounded-sm
                    border-primary
                    w-5
                    h-5
                    flex flex-shrink-0
                    justify-center
                    cursor-pointer
                    items-center
                    focus-within:border-blue-500 focus-within:bg-primary
                  "
                >
                  <div
                    class="h-3 w-3 bg-pink rounded-sm"
                    :class="[
                      addressType === 'customAddress' ? 'block' : 'hidden',
                    ]"
                  ></div>
                </div>
                <label
                  class="font-bold select-none pl-5 cursor-pointer"
                  for="customAddress"
                >
                  <div class="flex flex-col">
                    <p class="mr-2 font-bold">Custom Address</p>
                  </div>
                </label>
              </div>
            </div>

            <div v-if="addressType === 'customAddress'">
              <InputText
                id="name"
                v-model="form.name"
                type="text"
                label="recipient's name"
                class="mt-14 mb-10"
                background-color="white"
                variant="outlined"
              />
              <InputText
                id="phone-number"
                v-model="form.phone"
                type="tel"
                pattern="\d{8,13}"
                class="mb-10"
                label="recipient's phone ex.081234567890"
                background-color="white"
                variant="outlined"
              />
              <InputSelect
                id="area"
                v-model="form.area"
                variant="outlined"
                background-color="white"
                placeholder="Area"
                :options="areas"
                label="area"
                class="mb-10"
              />
              <InputText
                id="address"
                v-model="form.address"
                type="text"
                label="receipient's address"
                class="mb-7"
                background-color="white"
                variant="outlined"
              />
            </div>

            <InputDate
              id="delivery-date"
              v-model="form.time"
              placeholder="select delivery time"
              :min="getMinDate()"
              class="mb-8"
              label="select delivery time"
            />

            <div class="mb-10 border-b-2 border-secondary">
              <label for="request" class="font-bold text-lg font-serif"
                >Any Delivery Request?</label
              >
              <InputTextArea
                id="request"
                v-model="form.request"
                :required="false"
                class="my-5"
                rows="6"
                classes="bg-white"
                placeholder="ex: leave it in front of the gate"
              />
            </div>
          </template>

          <div
            v-for="item in shipment"
            :key="item.id"
            class="flex justify-between w-full items-end"
          >
            <p class="font-serif line-clamp-1">{{ item.productName }}</p>
            <p class="font-bold">
              {{ $currencyFormat(item.subtotalPrice * item.qty) }}
            </p>
          </div>
          <div
            v-if="deliveryMethod === 'delivery'"
            class="flex justify-between w-full items-end"
          >
            <p class="font-serif">Delivery Fee</p>
            <p v-if="deliveryPrice === 0" class="font-bold text-red-400">
              Area not selected
            </p>
            <p v-else class="font-bold">
              {{ $currencyFormat(deliveryPrice) }}
            </p>
          </div>
          <div class="flex justify-between w-full items-end mt-10 font-bold">
            <p class="font-serif">Subtotal</p>
            <p>{{ $currencyFormat(subtotal) }}</p>
          </div>
          <div class="flex w-100 justify-center">
            <button
              type="submit"
              class="
                my-8
                py-2
                font-bold
                text-xl
                bg-secondary
                w-11/12
                sm:w-8/12
                rounded-md
                text-white
              "
            >
              proceed to payment
            </button>
            <p v-if="invoiceError" class="text-red-400 font-bold">
              Something went wrong, please try again
            </p>
          </div>
        </form>
      </div>
    </template>
    <ModalContainer
      id="modal-proceed-payment"
      title="Proceed to payment"
      :desc="`we'll redirect you to our payment page. ${
        loading ? 'Loading...' : ''
      }`"
      btn-close-title="cancel"
      btn-proceed-title="pay now"
      :btn-proceed-callback="() => proceedToPayment()"
    />
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Shipment',
  // beforeRouteLeave(to, from, next) {
  //   if (this.shipment.length > 0) {
  //     const answer = window.confirm(
  //       "Leave page? You'll have to reselect from your cart."
  //     )
  //     answer ? next() : next(false)
  //   } else {
  //     next()
  //   }
  // },
  middleware: 'auth',
  data() {
    return {
      deliveryMethod: 'delivery',
      addressType: 'currentAddress',
      form: {
        name: '',
        phone: '',
        area: '',
        address: '',
        time: '',
        request: '',
      },
      shipment: [],
      areas: [],
      loading: false,
      invoiceError: false,
    }
  },
  async fetch() {
    const res = await this.GET_ADDRESS_AREAS()
    this.areas = res.data.map((address) => {
      return {
        id: address.id,
        label: address.name,
        value: address.id,
      }
    })
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
      ADDRESS_AREAS: 'addressAreas/ADDRESS_AREAS',
    }),
    deliveryPrice() {
      if (
        this.ADDRESS_AREAS?.data &&
        this.shipment.length > 0 &&
        this.deliveryMethod === 'delivery'
      ) {
        let area = {
          small_price: 0,
          medium_price: 0,
        }
        switch (this.addressType) {
          case 'customAddress':
            if (this.form.area) {
              area = this.ADDRESS_AREAS.data.find(
                (area) => area.id === this.form.area
              )
            }

            break
          case 'currentAddress':
            area = this.ADDRESS_AREAS.data.find(
              (area) => area.id === this.$auth.user.addresses[0].address_area.id
            )
            break
        }
        if (this.shipment.length > 1) {
          return area.medium_price
        }

        return this.shipment[0].size === 'Classic' && this.shipment[0].qty === 1
          ? area.small_price
          : area.medium_price
      }
      return 0
    },
    subtotal() {
      if (this.shipment) {
        const itemsPrice = this.shipment.reduce((acc, val) => {
          return (acc += val.subtotalPrice * val.qty)
        }, 0)
        return itemsPrice + this.deliveryPrice
      }
      return 0
    },
  },
  mounted() {
    this.shipment = this.$getStorage('bloomwoodShipment') || []
  },
  methods: {
    ...mapActions({
      GET_ADDRESS_AREAS: 'addressAreas/GET_ADDRESS_AREAS',
      GET_CART_COUNT: 'GET_CART_COUNT',
    }),
    handleMethod(method) {
      this.deliveryMethod = method
    },
    getMinDate() {
      const currentDate = new Date()
      const offset = currentDate.getTimezoneOffset()
      const formattedDate = new Date(currentDate.getTime() - offset * 60 * 1000)
      return formattedDate.toISOString().split('T')[0]
    },
    showConfirmModal() {
      this.$modal.show('modal-proceed-payment')
    },
    async proceedToPayment() {
      try {
        this.loading = true
        const products = this.shipment
          .reduce((acc, val) => {
            if (val.qty > 1) {
              for (let i = 0; i < val.qty; i++) {
                acc = [...acc, val]
              }
              return acc
            }
            return [...acc, val]
          }, [])
          .map((item) => {
            return {
              id: item.originalId,
              message: item.message ?? '',
              size: item.size,
              add_ons:
                item.addOns.length > 0
                  ? item.addOns.map((addOn) => {
                      return { id: addOn.id }
                    })
                  : [{ id: '' }],
              variant_id: item.variant?.id ?? '',
            }
          })

        let requestPayload = {}
        if (this.deliveryMethod !== 'delivery') {
          requestPayload = {
            notes: '',
            recipients_name: '',
            recipients_phone: '',
            delivery_time: '',
            address: '',
            address_area_id: '',
          }
        } else if (this.addressType === 'currentAddress') {
          requestPayload = {
            notes: this.form.request,
            recipients_name: this.$auth.user.name,
            recipients_phone: this.$auth.user.phone_number,
            delivery_time: this.form.time,
            address: this.$auth.user.addresses[0].address,
            address_area_id: this.$auth.user.addresses[0].address_area.id,
          }
        } else {
          requestPayload = {
            notes: this.form.request,
            recipients_name: this.form.name,
            recipients_phone: this.form.phone_number,
            delivery_time: this.form.time,
            address: this.form.address,
            address_area_id: this.form.area,
          }
        }

        const res = await this.$axios
          .$post('/api/invoices', {
            ...requestPayload,
            pick_up: this.deliveryMethod === 'delivery' ? 0 : 1,
            products,
          })
          .then((res) => {
            // this.$router.push('/accounts')
            const idsToDelete = new Set(this.shipment.map((item) => item.id))
            const cart = this.$getStorage('bloomwoodCart')
            const filteredCart = Object.entries(cart).reduce(
              (acc, [key, val]) => {
                if (!idsToDelete.has(key)) {
                  acc[key] = val
                }
                return acc
              },
              {}
            )
            this.$setStorage('bloomwoodShipment', [], 1000)
            this.$setStorage('bloomwoodCart', filteredCart, 1000)
            this.$router.push({
              path: '/account',
              query: {
                tab: 'order-history',
                payment_token: res.data.payment_token,
              },
            })
            // window.snap.pay(res.data.payment_token)
            this.invoiceError = false
            this.loading = false
            this.GET_CART_COUNT()
          })
      } catch (e) {
        this.invoiceError = true
        this.$modal.hide('modal-proceed-payment')
      } finally {
        this.loading = false
      }
    },
  },
}
</script>
<style></style>
