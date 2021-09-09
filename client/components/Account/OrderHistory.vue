<template>
  <div class="text-primary font-bold">
    <h2 class="text-3xl mb-10">My Order History</h2>
    <div class="grid grid-cols-1 gap-y-4">
      <div
        v-for="(history, idx) in 3"
        :key="idx"
        class="bg-tertiary rounded-xl py-10 px-14 w-full text-primary font-bold"
      >
        <div class="flex justify-between">
          <div class="flex items-center">
            <ContainedImage
              src="/flower-2.jpg"
              width="148"
              height="148"
              class="rounded-lg border-4 border-primary max-w-[140px] mr-4"
            />
            <div class="flex flex-col">
              <h2
                class="
                  font-bold font-serif
                  text-2xl
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
          <div class="flex flex-col justify-end items-end">
            <div class="text-center mb-5">
              <button
                class="pb-1 border-b border-brown text-center mb-3 font-bold"
              >
                pay now
              </button>
              <div
                class="
                  bg-success
                  min-w-[10rem]
                  py-2
                  text-center text-white
                  rounded-md
                  text-lg
                "
              >
                success
              </div>
            </div>
            <div class="font-bold text-2xl">
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
