<template>
  <div class="bg-tertiary rounded-xl py-14 px-20 w-full text-primary font-bold">
    <h2 class="text-3xl mb-14">My Order History</h2>
    <table class="table-auto w-full text-left overflow-x-scroll">
      <thead class="border-b-2 border-primary text-lg mb-4">
        <tr>
          <th
            v-for="header in ['Product', 'Quantity', 'Price', 'Payment Status']"
            :key="header"
            class="
              px-4
              py-3
              tracking-wider
              first:pl-0
              last:pr-0
              whitespace-nowrap
            "
          >
            {{ header }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(list, idx) in 5" :key="idx">
          <td class="pr-4 py-3">
            <div class="flex items-center">
              <ContainedImage
                width="75"
                height="75"
                src="/flower-2.jpg"
                :is-fluid="false"
                class="rounded-md border-2 border-primary mr-4"
              />
              <div class="flex flex-col">
                <h3 class="text-lg line-clamp-2 font-serif">
                  Cloud Catcher CAtcher cloud catch catch catch cloud catch
                  catch
                </h3>
                <span class="font-normal">17 Augustus 2021</span>
              </div>
            </div>
          </td>
          <td class="px-4 py-3 text-lg text-center">1</td>
          <td class="px-4 py-3 text-lg">{{ $currencyFormat(2750000) }}</td>
          <td class="px-4 py-3">
            <div
              class="
                text-center text-white
                bg-success
                px-4
                py-2
                w-full
                rounded-md
              "
              style="max-width: 170px"
            >
              success
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'AccountOrderHistory',
}
</script>
