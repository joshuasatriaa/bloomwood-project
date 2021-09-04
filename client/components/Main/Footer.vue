<template>
  <footer class="bg-brown pt-10 pb-7 font-serif">
    <div class="container mx-auto text-white">
      <p class="flex justify-evenly mb-10">
        <NuxtLink to="/">About Us</NuxtLink>
        <NuxtLink to="/contact-us">Contact Us</NuxtLink>
        <NuxtLink to="/care-instructions">Care Instruction</NuxtLink>
      </p>
      <div class="flex flex-col items-center mb-10">
        <IconLogo class="transform scale-150 text-center mb-10" />
        <ul class="font-sans font-normal">
          <li class="flex mb-5">
            <IconEmail class="transform scale-75 mr-5" />
            bloomwoodflorist@gmail.com
          </li>
          <li class="flex mb-5">
            <IconWhatsapp class="transform scale-75 mr-5" /> (+62) 878-8800-9807
          </li>
        </ul>
      </div>
      <div class="block text-center md:flex justify-between">
        <span class="font-normal"
          >Copyrights @ 2017 BLOOMWOOD. All Rights Reserved.</span
        >
        <div class="flex justify-center items-center">
          <div class="flex mr-6">
            <span class="mr-4">Follow Us</span>
            <IconInstagram class="fill-current text-white" />
          </div>
          <div class="flex">
            <span class="mr-4">Also Available on</span>
            <ContainedImage
              src="/tokopedia_icon.png"
              width="22"
              height="22"
              :is-fluid="false"
              class="mr-5"
            />
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {}
</script>
<style></style>
