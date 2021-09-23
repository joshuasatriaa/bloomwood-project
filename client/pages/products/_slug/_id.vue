<template>
  <div class="relative">
    <!-- <div
      class="h- w-8/12 left-0 absolute"
      style="background-image: url('/bg-square.svg')"
    ></div> -->
    <div class="container mx-auto pt-20">
      <div
        v-if="!$fetchState.pending"
        class="grid grid-cols-1 lg:grid-cols-2 gap-x-14 text-primary relative"
      >
        <div>
          <ContainedImage
            :src="PRODUCT.data.images[0].original_image || '/'"
            width="650"
            height="650"
            aspect-class="aspect-w-650 aspect-h-650"
          />
        </div>
        <div class="mt-10 lg:mt-0">
          <h1 class="text-4xl mb-6">{{ PRODUCT.data.name }}</h1>
          <h2 class="text-lg font-bold text-pink mb-3">
            {{ PRODUCT.data.categories.map(({ name }) => name).join(', ') }}
          </h2>
          <p class="font-bold text-lg mb-6">
            {{ PRODUCT.data.description }}
          </p>
          <h3 class="text-2xl font-bold mb-5">Choose Size</h3>
          <ToggleButtonGroup
            class="mb-8"
            :buttons="getSizesButtonGroup(PRODUCT.data.sizes)"
            :current-value="form.size"
            @changed="(value) => (form.size = value)"
          />

          <template v-if="PRODUCT.data.variants.length > 0">
            <h3 class="text-2xl font-bold mb-5">Choose Variant</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 mb-8 gap-y-3">
              <template v-for="variant in PRODUCT.data.variants">
                <div :key="variant.id" class="flex items-center">
                  <input
                    :id="variant.id"
                    v-model="form.variant"
                    type="radio"
                    :name="variant.name"
                    :value="variant.id"
                    class="ring-primary checked:bg-primary"
                  />
                  <label :for="variant.id" class="ml-5 cursor-pointer">
                    <div class="flex items-center">
                      <ContainedImage
                        :src="variant.thumbnail_image"
                        width="50"
                        height="50"
                        class="max-w-[3.75rem] mr-5 rounded"
                        aspect-class="aspect-w-50 aspect-h-50"
                      />
                      <div class="flex flex-col text-lg">
                        <p class="font-bold">{{ variant.name }}</p>
                        <p>({{ $currencyFormat(variant.price) }})</p>
                      </div>
                    </div>
                  </label>
                </div>
              </template>
            </div>
          </template>

          <h3 class="text-2xl font-bold mb-1">Gift Card Message</h3>
          <p class="mb-4 text-sm">
            *Please include your message unless you wish to keep it anonymous
          </p>
          <InputTextArea
            id="message"
            v-model="form.message"
            class="mb-8"
            rows="6"
            minlength="5"
            placeholder="enter your gift card message (optional)"
          />

          <!-- <h3 class="text-2xl font-bold mb-5">Add Bundle</h3>
        <ToggleButtonGroup
          class="mb-8"
          :buttons="bundles"
          :current-value="currentBundle"
          @changed="(value) => (currentBundle = value)"
        /> -->

          <h3 class="text-2xl font-bold text-uppercase mb-8">
            {{ $currencyFormat(getFlowerOnlyPrice) }}
          </h3>

          <div class="flex gap-6 mb-12 flex-wrap">
            <div
              class="
                flex
                h-12
                w-full
                rounded
                relative
                bg-transparent
                text-primary
                border-2 border-primary
                font-bold
                max-w-[170px]
              "
            >
              <button
                type="button"
                class="h-full w-20 cursor-pointer outline-none"
                @click="() => form.qty--"
              >
                <span class="m-auto text-2xl font-thin">−</span>
              </button>
              <input
                v-model="form.qty"
                type="number"
                class="
                  outline-none
                  focus:outline-none
                  text-center
                  w-full
                  md:text-basecursor-default
                  flex
                  items-center
                  text-2xl
                  border-none
                "
                name="custom-input-number"
              />
              <button
                type="button"
                class="h-full w-20 cursor-pointer border-none"
                @click="() => form.qty++"
              >
                <span class="m-auto text-2xl font-thin">+</span>
              </button>
            </div>
            <!-- <button
            class="
              bg-primary
              text-white text-xl text-center
              font-bold
              rounded
              w-full
              h-12
              flex
              justify-center
              items-center
              relative
            "
            style="max-width: 420px"
          >
            <p>add to cart</p>
            <IconCart class="absolute fill-current text-white right-5" />
          </button> -->
          </div>

          <h3 class="text-2xl font-bold mb-5">Frequently Bought Together</h3>
          <div class="flex items-center flex-wrap mb-8">
            <div
              v-for="({ id, thumbnail_image }, idx) in PRODUCT.data.add_ons"
              :key="id"
              class="flex items-center"
            >
              <div class="w-full">
                <ContainedImage
                  :src="thumbnail_image"
                  class="
                    border-[#F4F3EE]
                    min-w-[120px] min-h-[80px]
                    sm:min-w-[135px] sm:min-h-[90px]
                    md:min-w-[162px] md:min-h-[108px]
                    lg:min-w-[162px] lg:min-h-[108px]
                    border-4
                    rounded-md
                    w-full
                  "
                  width="162"
                  height="108"
                  aspect-class="aspect-w-162 aspect-h-108"
                />
              </div>
              <span
                v-if="idx + 1 !== PRODUCT.data.add_ons.length"
                class="hidden sm:block text-lg font-bold mx-4"
                >+</span
              >
            </div>
          </div>

          <p class="text-xl mb-6 font-serif">
            <span>Total Price IDR {{ $currencyFormat(totalPrice) }} </span>
            <span class="line-through">{{
              $currencyFormat(totalPrice + (10 / 100) * totalPrice)
            }}</span>
          </p>

          <div class="mb-10 font-serif">
            <div
              v-for="{ id, name, price } in PRODUCT.data.add_ons"
              :key="id"
              class="flex items-center relative my-4 flex-wrap"
            >
              <input
                :id="id"
                v-model="form.addOns[id]"
                type="checkbox"
                class="opacity-0 absolute h-5 w-5 cursor-pointer"
                :name="id"
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
                  :class="[form.addOns[id] ? 'block' : 'hidden']"
                ></div>
              </div>
              <label
                :for="id"
                class="text-lg font-bold select-none ml-5 cursor-pointer"
              >
                <div class="flex flex-col md:flex-row md:items-center">
                  <p class="mr-2">{{ name }}</p>
                  <!-- <InputSelect
                  id="area"
                  v-model="form.test"
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
                  variant="outlined"
                  height="short"
                  font-size="small"
                  class="mx-3"
                  style="min-width: 150px"
                /> -->
                  <span class="font-normal"
                    >({{ $currencyFormat(price) }})</span
                  >
                </div>
              </label>
            </div>
          </div>

          <button
            class="
              bg-primary
              text-white text-xl text-center
              font-bold
              rounded
              w-full
              h-12
              flex
              justify-center
              items-center
              relative
            "
            style="max-width: 420px"
            @click="addToCart"
          >
            <p>save to cart</p>
            <IconCart class="absolute fill-current text-white right-5" />
          </button>

          <Accordion
            class="mt-10"
            :default-open="false"
            title="Delivery Details"
          >
            <ul class="list-disc ml-5">
              <li>Deliveries will be charged based on location.</li>
              <li>Flowers will be delivered between 12pm and 5pm.</li>
              <li>
                For deliveries before 12:00pm , will subject to flower
                availability. For delivery time requests kindly contact us
                directly at +62 878-8123-5897
              </li>
              <li>
                Flowers will be delivered in our signature packaging with a
                complimentary type-written gift card message.
              </li>
            </ul>
          </Accordion>

          <Accordion class="mt-5" :default-open="false" title="Flower Care">
            <p class="mb-4">For Bloom Bouquet:</p>
            <ul class="list-disc ml-5 mb-10">
              <li>
                Trim at least 1,5 cm of stems at a 45° angle before you put them
                in a vase and each time you change the water.
              </li>
              <li>
                Remove any foliage in the water as it will decompose faster and
                spoiling your flowers.
              </li>
              <li>
                Change to clean water every 2 days, keep them in a cool place
                out of direct sunlight.
              </li>
            </ul>
            <p class="mb-4">For Bloomloop & Pot arrangements :</p>
            <ul class="list-disc ml-5">
              <li>
                Carefully top up the oasis with water everyday & your blooms
                should stay looking perky! *
              </li>
            </ul>
            <small class="italic font-medium"
              >*Depending on environment that flowers are placed in.</small
            >
          </Accordion>
        </div>
      </div>
      <ModalContainer
        id="modal-add-cart"
        title="Added to Cart"
        desc="item successfully added to cart"
        btn-close-title="okay"
      />
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Product',
  data() {
    return {
      form: {
        qty: 1,
        size: '',
        message: '',
        addOns: {},
        variant: '',
      },
    }
  },
  async fetch() {
    await this.GET_PRODUCT(this.$route.params.id)
    this.form.size = this.PRODUCT.data.sizes[0].name
    this.form.variant =
      this.PRODUCT.data.variants.length > 0
        ? this.PRODUCT.data.variants[0].id
        : ''
  },

  computed: {
    ...mapGetters({
      PRODUCT: 'products/PRODUCT',
    }),
    getFlowerOnlyPrice() {
      if (this.PRODUCT.data && this.form.size) {
        const size = this.PRODUCT.data.sizes.find((size) => {
          return this.form.size === size.name
        })
        return size.price
      }
      return 0
    },
    totalPrice() {
      if (this.PRODUCT.data) {
        const addOnsPrice = Object.keys(this.form.addOns)
          .filter((key) => this.form.addOns[key])
          .map((key) => {
            const { price } = this.PRODUCT.data.add_ons.find(
              (addOn) => key === addOn.id
            )
            return price
          })
          .reduce((acc, val) => {
            return acc + val
          }, 0)
        return this.form.qty * (this.getFlowerOnlyPrice + addOnsPrice)
      }
      return 0
    },
  },
  methods: {
    ...mapActions({
      GET_PRODUCT: 'products/GET_PRODUCT',
      GET_CART_COUNT: 'GET_CART_COUNT',
    }),
    addToCart() {
      const bloomwoodCart = this.$getStorage('bloomwoodCart') || {}
      const addOns = Object.keys(this.form.addOns).filter(
        (addOn) => this.form.addOns[addOn] === true
      )
      const addOnsAppendedString =
        addOns.length < 1 ? '' : `-${addOns.join('-')}`
      const objName = `${this.PRODUCT.data.id}${addOnsAppendedString}`
      let objToSave = {}

      if (bloomwoodCart[objName]) {
        objToSave = {
          ...bloomwoodCart,
          [objName]: {
            ...bloomwoodCart[objName],
            qty: bloomwoodCart[objName].qty + this.form.qty,
          },
        }
      } else {
        const filteredAddOns = this.PRODUCT.data.add_ons.filter((addOn) => {
          return this.form.addOns[addOn.id]
        })

        let variant = null
        if (this.PRODUCT.data.variants) {
          variant = this.PRODUCT.data.variants.find(
            (variant) => this.form.variant === variant.id
          )
        }

        console.log(filteredAddOns)
        objToSave = {
          ...bloomwoodCart,
          [`${objName}`]: {
            ...this.form,
            id: this.PRODUCT.data.id,
            productName: this.PRODUCT.data.name,
            subtotalPrice:
              this.getFlowerOnlyPrice +
              filteredAddOns.reduce((acc, curr) => {
                return (acc += curr.price)
              }, 0) +
              (variant ? variant.price : 0),
            productImage: this.PRODUCT.data.images[0].thumbnail_image,
            addOns: filteredAddOns,
            variant,
          },
        }
      }
      this.$setStorage('bloomwoodCart', objToSave, 1000)
      this.$modal.show('modal-add-cart')
      this.GET_CART_COUNT()
    },
    getSizesButtonGroup() {
      return this.PRODUCT.data.sizes.map(({ name }) => {
        return {
          value: name,
          label: name,
        }
      })
    },
  },
}
</script>
<style>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* input:checked + div {
  @apply bg-pink;
} */

input:checked + div div {
  @apply block;
}
</style>
