<template>
  <div class="container mx-auto pt-20">
    <div class="grid grid-cols-2 text-primary">
      <img src="/flower-3.jpg" alt="" />
      <div>
        <h1 class="text-4xl mb-6">All Things Ethereal in Pink</h1>
        <h2 class="text-lg font-bold text-pink mb-3">Bloom Loop</h2>
        <p class="font-bold text-lg mb-6">
          Deluxe Bloomloop filled with Fresh Hydrangeas, Roses, &
          Crowd-Favourite Dyed Phalaenopsis in One Beautiful Arrangement.
          Perfect for Birthday Flower or to cheer up loved ones day ! Please
          Note : The photo shown is for reference only. We will always use the
          freshest seasonal flowers available in similar color hues.
        </p>
        <h3 class="text-2xl font-bold mb-5">Choose Size</h3>
        <ToggleButtonGroup
          class="mb-8"
          :buttons="sizes"
          :current-value="currentSize"
          @changed="(value) => (currentSize = value)"
        />

        <h3 class="text-2xl font-bold mb-5">Gift Card Message</h3>
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
          {{ $currencyFormat(6750000) }}
        </h3>

        <div class="flex space-x-6 mb-12">
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
              @click="() => total--"
            >
              <span class="m-auto text-2xl font-thin">−</span>
            </button>
            <input
              v-model="total"
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
              @click="() => total++"
            >
              <span class="m-auto text-2xl font-thin">+</span>
            </button>
          </div>
          <button
            class="
              bg-primary
              text-white text-lg text-center
              font-bold
              rounded
              w-full
            "
            style="max-width: 420px"
          >
            add to cart
          </button>
        </div>

        <h3 class="text-2xl font-bold mb-5">Frequently Bought Together</h3>
        <div class="flex items-center mb-8">
          <template v-for="(item, idx) in 3">
            <div :key="idx" class="flex flex-row items-center">
              <ContainedImage
                src="/wine.jpg"
                class="border-[#F4F3EE] border-4 rounded-md"
                width="162"
                height="108"
                :is-fluid="false"
              />
              <span class="text-lg font-bold mx-4">+</span>
            </div>
          </template>
        </div>

        <p class="text-xl mb-6">
          <span>Total Price IDR 3.150.000 </span>
          <span class="line-through">3.500.000</span>
        </p>

        <div>
          <div
            v-for="item in ['Flower Bundle', 'Chocolate Cake', 'Premium Wine']"
            :key="item"
            class="flex items-center relative my-4"
          >
            <input
              type="checkbox"
              class="opacity-0 absolute h-5 w-5"
              :name="item"
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
              <div class="h-3 w-3 bg-pink hidden"></div>
            </div>
            <label :for="item" class="text-lg font-bold select-none ml-4">
              <div class="flex items-center">
                <p>{{ item }}</p>
                <InputSelect
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
                />
                <span class="font-normal"
                  >({{ $currencyFormat(1500000) }})</span
                >
              </div>
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      currentSize: '',
      currentBundle: '',
      form: {
        test: '',
      },
      total: 1,
      sizes: [
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
      ],
      bundles: [
        {
          id: 'Cake-123',
          value: 'Cake',
          label: 'Cake',
        },
        {
          id: 'Wine-123',
          value: 'Wine',
          label: 'Wine',
        },
        {
          id: 'Chocolate-123',
          value: 'Chocolate',
          label: 'Chocolate',
        },
      ],
    }
  },
  async mounted() {
    const res = await this.$axios.$get('/api/products/6128c8c72799b71e1a7e932f')
    console.log(res)
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
