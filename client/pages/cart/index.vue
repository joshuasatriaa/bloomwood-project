<template>
  <div class="container mx-auto mt-10">
    <h1 class="text-3xl font-normal mb-14 font-serif text-primary">
      Items in my cart
    </h1>
    <div
      v-for="(temp, idx) in 4"
      :key="idx"
      class="bg-tertiary rounded-xl px-8 pt-8 pb-5 text-primary mb-5"
    >
      <div class="flex justify-between">
        <div class="flex items-center">
          <div class="flex items-center relative my-4 flex-wrap mr-8">
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
          </div>
          <ContainedImage
            src="/flower-2.jpg"
            width="148"
            height="148"
            class="rounded-lg border-4 bg-primary max-w-[140px] mr-4"
          />
          <div class="flex flex-col">
            <h2 class="font-bold font-serif text-lg mb-2">Cloud Catcher</h2>
            <span>Size: Medium</span>
            <span>Bundle: None</span>
          </div>
        </div>
        <div class="flex flex-col justify-between items-end">
          <IconTrash class="transform scale-75 align" />
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
                  class="w-10 cursor-pointer outline-none"
                  @click="() => form.total--"
                >
                  <span class="m-auto">−</span>
                </button>
                <input
                  v-model="form.total"
                  type="number"
                  class="
                    outline-none
                    focus:outline-none
                    text-center
                    md:text-basecursor-default
                    flex-shrink flex
                    items-center
                    justify-center
                    bg-transparent
                    max-w-[30px]
                    font-bold
                  "
                  name="custom-input-number"
                />
                <button
                  type="button"
                  class="h-full w-10 cursor-pointer"
                  @click="() => form.total++"
                >
                  <span class="m-auto">+</span>
                </button>
              </div>
            </div>
            <div class="font-bold">
              {{ $currencyFormat(2750000) }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full flex flex-col items-end justify-end mt-14 text-primary">
      <div class="flex flex-col">
        <div class="flex">
          <p class="mr-10 font-serif">Subtotal</p>
          <p class="font-bold">{{ $currencyFormat(7500000) }}</p>
        </div>
        <button
          type="button"
          class="
            font-bold
            text-lg
            py-1
            bg-primary
            text-white
            rounded
            w-full
            mt-5
          "
        >
          checkout
        </button>
      </div>
    </div>
    <NuxtLink to="/cart/shipment">go to shipment</NuxtLink>
  </div>
</template>
<script>
export default {
  name: 'Cart',
  middleware: 'auth',
  data() {
    return {
      form: {
        total: 1,
      },
    }
  },
}
</script>
<style></style>
