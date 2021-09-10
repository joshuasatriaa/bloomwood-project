<template>
  <div class="text-primary font-bold">
    <h2 class="text-3xl mb-10">My Order History</h2>
    <div class="grid grid-cols-1 gap-y-4">
      <div
        v-for="(history, idx) in 3"
        :key="idx"
        class="
          bg-tertiary
          rounded-xl
          p-3
          sm:py-10 sm:px-14
          w-full
          text-primary
          font-bold
        "
      >
        <div class="flex justify-between flex-col xl:flex-row">
          <div class="flex flex-col sm:flex-row sm:items-center">
            <ContainedImage
              src="/flower-2.jpg"
              width="148"
              height="148"
              class="
                rounded-lg
                border-4 border-primary
                max-w-[140px]
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
                Cloud Catcher Cloud Catcher Cloud Catcher Cloud Catcher Cloud
                Catcher Cloud Catcher Cloud Catcher
              </h2>
              <span class="font-normal mb-2">17 August 2021</span>
              <span class="font-normal">Quantity: 1</span>
            </div>
          </div>
          <div
            class="flex xl:flex-col justify-between xl:justify-end items-end"
          >
            <div class="text-center xl:mb-5 order-2 xl:order-1">
              <button
                class="pb-1 border-b border-brown text-center mb-3 font-bold"
              >
                pay now
              </button>
              <div
                class="
                  bg-success
                  min-w-[6rem]
                  sm:min-w-[10rem]
                  py-2
                  text-center text-white
                  rounded-md
                  text-base
                  sm:text-lg
                "
              >
                waiting
              </div>
            </div>
            <div class="font-bold text-lg sm:text-2xl xl:order-2">
              {{ $currencyFormat(2750000) }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AccountOrderHistory',
}
</script>
