<template>
  <div class="container mx-auto mt-10">
    <h1 class="text-3xl font-normal mb-14 font-serif text-primary">
      Select Delivery Address & Time
    </h1>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-4 text-primary">
      <div>
        <template v-for="(product, idx) in 3">
          <div
            :key="idx"
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
              <div class="flex">
                <ContainedImage
                  src="/flower-2.jpg"
                  width="148"
                  height="148"
                  class="rounded-lg border-4 border-primary max-w-[120px] mr-4"
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
                    Red and Everything Nice
                  </h2>
                  <span>Size: Medium</span>
                  <span>Bundle: None</span>
                </div>
              </div>
              <div class="font-bold text-right text-lg">
                {{ $currencyFormat(7500000) }}
              </div>
            </div>
          </div>
        </template>
      </div>
      <div class="bg-tertiary rounded-xl p-5">
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
            @click="() => handleMethod('delivery')"
          >
            <IconTruck class="mb-2" />
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
            :class="[deliveryMethod === 'pickup' ? 'bg-white' : 'bg-[#D9D5D2]']"
            @click="() => handleMethod('pickup')"
          >
            <IconBag class="mb-2" />
            <span class="font-bold text-sm">Self Pick Up</span>
          </button>
        </div>

        <div class="mb-10 font-serif">
          <div class="flex relative my-4">
            <input type="checkbox" class="opacity-0 absolute h-5 w-5" />
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
              <div class="h-3 w-3 bg-pink rounded-sm"></div>
            </div>
            <label class="font-bold select-none ml-5">
              <div class="flex flex-col">
                <p class="mr-2 font-normal">My Current Address</p>
                <span class="font-bold font-sans text-sm"
                  >Jalan Sudirman (Perumahan Mahkota) Nomor 12, 14410</span
                >
              </div>
            </label>
          </div>
        </div>

        <div class="mb-8 font-serif">
          <div class="flex relative my-4">
            <input type="checkbox" class="opacity-0 absolute h-5 w-5" />
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
              <div class="h-3 w-3 bg-pink rounded-sm"></div>
            </div>
            <label class="font-bold select-none ml-5">
              <div class="flex flex-col">
                <p class="mr-2 font-normal">Custom Address</p>
              </div>
            </label>
          </div>
        </div>

        <InputDate
          id="delivery-date"
          placeholder="select delivery time"
          class="mb-8"
        />

        <div class="mb-10 border-b-2 border-secondary">
          <label for="request" class="font-bold text-lg font-serif"
            >Any Delivery Request?</label
          >
          <InputTextArea
            id="request"
            class="my-5"
            rows="6"
            minlength="5"
            classes="bg-white"
            placeholder="ex: leave it in front of the gate"
          />
        </div>

        <div class="flex justify-between w-full items-end">
          <p class="font-serif line-clamp-1">Red and Everything Nice</p>
          <p class="font-bold">{{ $currencyFormat(7500000) }}</p>
        </div>
        <div class="flex justify-between w-full items-end">
          <p class="font-serif">Delivery Fee</p>
          <p class="font-bold">{{ $currencyFormat(6000) }}</p>
        </div>
        <div class="flex justify-between w-full items-end">
          <p class="font-serif">Additional Fee</p>
          <p class="font-bold">{{ $currencyFormat(26000) }}</p>
        </div>
        <div class="flex justify-between w-full items-end mt-10 font-bold">
          <p class="font-serif">Subtotal</p>
          <p>{{ $currencyFormat(7532000) }}</p>
        </div>
        <div class="flex w-100 justify-center">
          <button
            type="button"
            class="
              my-8
              py-2
              font-bold
              text-lg
              bg-primary
              w-8/12
              rounded-sm
              text-white
            "
          >
            proceed to payment
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Shipment',
  beforeRouteLeave(to, from, next) {
    const answer = window.confirm(
      "Leave page? You'll have to reselect from your cart."
    )
    answer ? next() : next(false)
  },
  middleware: 'auth',
  data() {
    return {
<<<<<<< HEAD
      deliveryMethod: 'delivery',
    }
  },
  methods: {
    handleMethod(method) {
      console.log(method)
      this.deliveryMethod = method
    },
  },
=======
      shipmentType: '',
    }
  },
>>>>>>> d927aa44ed2a3ecaa913620de05b6b7e6572cb9b
}
</script>
<style></style>
