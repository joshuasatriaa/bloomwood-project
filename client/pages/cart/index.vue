<template>
  <div class="container mx-auto mt-10">
    <client-only>
      <h1 class="text-3xl font-normal mb-14 font-serif text-primary">
        Items in my cart
      </h1>
      <template v-if="Object.keys(cart).length > 0">
        <div
          v-for="key in Object.keys(cart)"
          :key="key"
          class="bg-tertiary rounded-xl px-8 pt-8 pb-5 text-primary mb-5"
        >
          <div class="flex justify-between">
            <div class="flex items-center">
              <div class="flex items-center relative my-4 flex-wrap mr-8">
                <input
                  v-model="checkedItems[key]"
                  type="checkbox"
                  class="opacity-0 absolute h-5 w-5"
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
                    focus-within:border-blue-500 focus-within:bg-primary
                  "
                >
                  <div
                    class="h-3 w-3 bg-pink rounded-sm"
                    :class="[checkedItems[key] ? 'block' : 'hidden']"
                  ></div>
                </div>
              </div>
              <ContainedImage
                :src="cart[key].productImage"
                width="148"
                height="148"
                class="rounded-lg border-4 border-primary max-w-[140px] mr-4"
              />
              <div class="flex flex-col">
                <h2 class="font-bold font-serif text-lg mb-2">
                  {{ cart[key].productName }}
                </h2>
                <span>Size: {{ cart[key].size }}</span>
                <span v-if="cart[key].addOns.length > 0"
                  >Bundle:
                  {{
                    cart[key].addOns.map(({ name }) => name).join(', ')
                  }}</span
                >
              </div>
            </div>
            <div class="flex flex-col justify-between items-end">
              <button
                type="button"
                @click="
                  () => {
                    currentKey = key
                    $modal.show('modal-delete')
                  }
                "
              >
                <IconTrash
                  class="
                    transform
                    scale-75
                    fill-current
                    transition-transform
                    text-primary
                    hover:scale-100
                  "
                />
              </button>

              <div class="flex gap-x-20 items-end">
                <div class="flex-col text-center">
                  <p class="font-bold text-sm">Quantity</p>
                  <div
                    class="
                      flex
                      mt-2
                      w-full
                      relative
                      bg-transparent
                      text-primary
                      font-bold
                    "
                    style="max-width: 170px"
                  >
                    <button
                      type="button"
                      :disabled="cart[key].qty === 1"
                      class="w-10 cursor-pointer outline-none"
                      @click="() => changeQty('minus', key)"
                    >
                      <span class="m-auto">−</span>
                    </button>
                    <p class="font-bold">
                      {{ cart[key].qty }}
                    </p>
                    <button
                      type="button"
                      class="h-full w-10 cursor-pointer"
                      @click="() => changeQty('plus', key)"
                    >
                      <span class="m-auto">+</span>
                    </button>
                  </div>
                </div>
                <div class="font-bold">
                  {{ $currencyFormat(cart[key].subtotalPrice * cart[key].qty) }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="w-full flex flex-col items-end justify-end mt-14 text-primary"
        >
          <div class="flex flex-col items-end">
            <div class="flex mb-5">
              <p class="mr-10 font-serif">Subtotal</p>
              <p class="font-bold">{{ $currencyFormat(getTotalBySelected) }}</p>
            </div>
            <template v-if="!$auth.user">
              <p class="text-red-400 font-bold text-right">
                you need to login before checkout.
                <NuxtLink to="/accounts/login" class="text-brown underline"
                  >Login</NuxtLink
                >
              </p>
            </template>
            <template
              v-else-if="
                Object.keys(checkedItems).filter((key) => checkedItems[key])
                  .length < 1
              "
            >
              <p class="text-red-400 font-bold text-right">
                please select item before checkout.
              </p>
            </template>

            <button
              :disabled="!$auth.user || Object.keys(checkedItems).length < 1"
              type="button"
              class="
                font-bold
                text-lg
                py-2
                bg-primary
                text-white
                rounded
                w-full
                disabled:bg-gray-400
                disabled:text-gray-600
                disabled:cursor-not-allowed
              "
              @click="checkout"
            >
              checkout
            </button>
          </div>
        </div>
      </template>
      <template v-else>
        <div>
          <p class="font-bold text-primary text-lg">Oops no item yet</p>
          <div class="flex w-full justify-center">
            <div class="mt-8 flex flex-col items-center">
              <ContainedImage
                src="/empty-cart.svg"
                alt="empty cart illustration"
                width="425"
                height="333"
              />
              <button
                type="button"
                class="
                  bg-primary
                  font-bold
                  text-white
                  mt-10
                  w-11/12
                  py-2
                  rounded
                  text-lg
                "
              >
                back to home
              </button>
            </div>
          </div>
        </div>
      </template>
    </client-only>
    <ModalContainer
      id="modal-delete"
      title="Confirmation"
      desc="please confirm to remove the selected item from your cart"
      btn-close-title="cancel"
      btn-proceed-title="confirm"
      :btn-proceed-callback="() => deleteItem()"
    />
  </div>
</template>
<script>
export default {
  name: 'Cart',
  data() {
    return {
      form: {
        total: 1,
      },
      cart: {},
      currentKey: '',
      checkedItems: {},
    }
  },
  computed: {
    getTotalBySelected() {
      let totalSelected = 0
      for (const [key, value] of Object.entries(this.checkedItems)) {
        if (value) {
          totalSelected += this.cart[key].subtotalPrice * this.cart[key].qty
        }
      }
      return totalSelected
    },
  },
  mounted() {
    this.cart = this.$getStorage('bloomwoodCart') || {}
  },
  methods: {
    async changeQty(operator, key) {
      await this.$setStorage(
        'bloomwoodCart',
        {
          ...this.cart,
          [key]: {
            ...this.cart[key],
            qty:
              operator === 'plus'
                ? (this.cart[key].qty += 1)
                : (this.cart[key].qty -= 1),
          },
        },
        1000
      )
    },
    deleteItem() {
      try {
        const key = this.currentKey
        const { [key]: value, ...otherItems } = this.cart
        console.log('clicked', otherItems)
        this.$setStorage('bloomwoodCart', otherItems, 1000)
        this.cart = otherItems
        this.$modal.hide('modal-delete')
      } catch (e) {
        console.log(e)
      }
    },
    checkout() {
      try {
        const selectedItemsArr = []
        Object.keys(this.checkedItems).forEach((key) => {
          if (this.checkedItems[key]) {
            selectedItemsArr.push({ ...this.cart[key], id: key })
          }
        })
        this.$setStorage('bloomwoodShipment', selectedItemsArr, 1000)
        this.$router.push(`${this.$route.path}/shipment`)
      } catch (e) {
        console.log(e)
      }
    },
  },
}
</script>
<style></style>
