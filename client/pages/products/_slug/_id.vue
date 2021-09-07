<template>
  <div class="container mx-auto pt-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-5 text-primary">
      <ContainedImage
        :src="product.data.images[0].original_image"
        alt=""
        width="650"
        height="650"
      />
      <div class="mt-10 lg:mt-0">
        <h1 class="text-4xl mb-6">{{ product.data.name }}</h1>
        <h2 class="text-lg font-bold text-pink mb-3">Bloom Loop</h2>
        <p class="font-bold text-lg mb-6">
          {{ product.data.description }}
        </p>
        <h3 class="text-2xl font-bold mb-5">Choose Size</h3>
        <ToggleButtonGroup
          class="mb-8"
          :buttons="sizes"
          :current-value="form.size"
          @changed="(value) => (form.size = value)"
        />

        <h3 class="text-2xl font-bold mb-1">Gift Card Message</h3>
        <p class="mb-4 text-sm">
          *Please include your message unless you wish to keep it anonymous
        </p>
        <InputTextArea
          id="message"
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
          {{ $currencyFormat(product.data.price) }}
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
            "
            style="max-width: 170px"
          >
            <button
              type="button"
              class="h-full w-20 cursor-pointer outline-none"
              @click="() => form.total--"
            >
              <span class="m-auto text-2xl font-thin">−</span>
            </button>
            <input
              v-model="form.total"
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
              "
              name="custom-input-number"
            />
            <button
              type="button"
              class="h-full w-20 cursor-pointer"
              @click="() => form.total++"
            >
              <span class="m-auto text-2xl font-thin">+</span>
            </button>
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
          >
            <p>add to cart</p>
            <IconCart class="absolute fill-current text-white right-5" />
          </button>
        </div>

        <h3 class="text-2xl font-bold mb-5">Frequently Bought Together</h3>
        <div class="flex items-center mb-8">
          <template
            v-for="({ id, thumbnail_image }, idx) in product.data.add_ons"
          >
            <div :key="id" class="flex flex-row items-center">
              <ContainedImage
                :src="thumbnail_image"
                class="border-[#F4F3EE] border-4 rounded-md"
                width="162"
                height="108"
                :is-fluid="false"
              />
              <span
                v-if="idx + 1 !== product.data.add_ons.length"
                class="text-lg font-bold mx-4"
                >+</span
              >
            </div>
          </template>
        </div>

        <p class="text-xl mb-6 font-serif">
          <span>Total Price IDR 3.150.000 </span>
          <span class="line-through">3.500.000</span>
        </p>

        <div class="mb-10 font-serif">
          <div
            v-for="{ id, name, price } in product.data.add_ons"
            :key="id"
            class="flex items-center relative my-4 flex-wrap"
          >
            <input
              :id="id"
              v-model="form.addOns[id].checked"
              type="checkbox"
              class="opacity-0 absolute h-5 w-5"
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
                focus-within:border-blue-500 focus-within:bg-primary
              "
            >
              <div
                class="h-3 w-3 bg-pink rounded-sm"
                :class="[form.addOns[id].checked ? 'block' : 'hidden']"
              ></div>
            </div>
            <label :for="id" class="text-lg font-bold select-none ml-5">
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
                <span class="font-normal">({{ $currencyFormat(price) }})</span>
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
        >
          <p>save to cart</p>
          <IconCart class="absolute fill-current text-white right-5" />
        </button>

        <Accordion class="mt-10" title="Delivery Details">
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

        <Accordion class="mt-5" title="Flower Care">
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
              Change to clean water every 2 days, keep them in a cool place out
              of direct sunlight.
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
  </div>
</template>
<script>
import {
  useRoute,
  computed,
  watch,
  ref,
  onMounted,
} from '@nuxtjs/composition-api'
import { useGetProduct } from '@/composables/useProduct'

export default {
  setup() {
    const route = useRoute()

    const { product, getProduct } = useGetProduct()

    // console.log(product.value.data.name)

    const sizes = ref([
      {
        id: 'Small-123',
        value: 'Small',
        label: 'Small',
      },
      {
        id: 'Medium-123',
        value: 'Medium',
        label: 'Medium',
      },
      {
        id: 'Large-123',
        value: 'Large',
        label: 'Large',
      },
    ])

    const currentSize = ref('')

    const form = ref({
      total: 1,
      size: '',
      addOns: computed(() => {
        return product.value.data.add_ons.reduce((acc, curr) => {
          return {
            ...acc,
            [curr.id]: {
              id: curr.id,
              price: curr.price,
              name: curr.name,
              checked: false,
            },
          }
        }, {})
      }),
    })

    // onMounted(() => {
    //   form.value.addOns =
    // })

    const handleCheckbox = (e) => {
      console.log(e.target.checked)
      console.log(e.target.name)
    }

    // return { ...product.value.data, getProduct }
    return { product, getProduct, handleCheckbox, form, sizes, currentSize }
  },
  // data() {
  //   return {
  //     currentSize: '',
  //     currentBundle: '',
  //     form: {
  //       test: '',
  //     },
  //     total: 1,
  //     sizes: [
  //       {
  //         id: 'Small-123',
  //         value: 'Small',
  //         label: 'Small',
  //       },
  //       {
  //         id: 'Medium-123',
  //         value: 'Medium',
  //         label: 'Medium',
  //       },
  //       {
  //         id: 'Large-123',
  //         value: 'Large',
  //         label: 'Large',
  //       },
  //     ],
  //     bundles: [
  //       {
  //         id: 'Cake-123',
  //         value: 'Cake',
  //         label: 'Cake',
  //       },
  //       {
  //         id: 'Wine-123',
  //         value: 'Wine',
  //         label: 'Wine',
  //       },
  //       {
  //         id: 'Chocolate-123',
  //         value: 'Chocolate',
  //         label: 'Chocolate',
  //       },
  //     ],
  //   }
  // },
  // async mounted() {
  //   const res = await this.$axios.$get('/api/products/6128c8c72799b71e1a7e932f')
  //   console.log(res)
  // },
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
