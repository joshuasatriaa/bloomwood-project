<template>
  <div class="flex flex-col items-center text-primary mt-10">
    <h1 class="text-3xl sm:text-5xl font-serif font-normal">Payment Success</h1>
    <p class="sm:text-lg font-bold mt-8">thank you for the purchases</p>
    <div class="flex flex-col items-center">
      <ContainedImage
        src="/payment-success.svg"
        width="425"
        height="321"
        alt="payment success illustrator"
        class="max-w-lg mt-16"
      />
      <button
        type="button"
        class="
          w-11/12
          py-2
          bg-primary
          text-white
          font-bold
          text-lg
          rounded
          mt-20
        "
        @click="$router.push('/')"
      >
        back to home
      </button>
    </div>
  </div>
</template>
<script>
export default {}
</script>
<style></style>
