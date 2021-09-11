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
            @click="handleMethod('delivery')"
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
            @click="handleMethod('pickup')"
          >
            <IconBag class="mb-2" />
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
                  :class="[
                    addressType === 'currentAddress' ? 'block' : 'hidden',
                  ]"
                ></div>
              </div>
              <label class="font-bold select-none pl-5" for="currentAddress">
                <div class="flex flex-col">
                  <p class="mr-2 font-normal">My Current Address</p>
                  <span class="font-bold font-sans text-sm"
                    >Jalan Sudirman (Perumahan Mahkota) Nomor 12, 14410</span
                  >
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
                  :class="[
                    addressType === 'customAddress' ? 'block' : 'hidden',
                  ]"
                ></div>
              </div>
              <label class="font-bold select-none pl-5" for="customAddress">
                <div class="flex flex-col">
                  <p class="mr-2 font-normal">Custom Address</p>
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
              v-model="form.phoneNumber"
              type="text"
              class="mb-10"
              label="recipient's phone number"
              background-color="white"
              variant="outlined"
            />
            <InputSelect
              id="area"
              v-model="form.area"
              variant="outlined"
              background-color="white"
              placeholder="Area"
              :options="[
                {
                  id: 1,
                  value: 'test',
                },
                {
                  id: 2,
                  value: 'test-2',
                },
              ]"
              label="Area"
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
            class="mb-8"
          />

          <div class="mb-10 border-b-2 border-secondary">
            <label for="request" class="font-bold text-lg font-serif"
              >Any Delivery Request?</label
            >
            <InputTextArea
              id="request"
              v-model="form.request"
              class="my-5"
              rows="6"
              minlength="5"
              classes="bg-white"
              placeholder="ex: leave it in front of the gate"
            />
          </div>
        </template>

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
      deliveryMethod: 'delivery',
      addressType: 'currentAddress',
      form: {
        name: '',
        phoneNumber: '',
        area: '',
        address: '',
        time: '',
        request: '',
      },
    }
  },
  methods: {
    handleMethod(method) {
      this.deliveryMethod = method
    },
  },
}
</script>
<style></style>
