<template>
  <footer class="bg-brown pt-10 pb-7">
    <div class="container mx-auto text-white">
      <p class="flex justify-evenly mb-10">
        <NuxtLink to="/">About Us</NuxtLink>
        <NuxtLink to="/contact-us">Contact Us</NuxtLink>
        <NuxtLink to="/care-instructions">Care Instruction</NuxtLink>
        <NuxtLink to="/sitemap">Sitemap</NuxtLink>
      </p>
      <div class="flex flex-col items-center mb-10">
        <IconLogo class="transform scale-150 text-center mb-10" />
        <ul>
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
        <span>Copyrights @ 2017 BLOOMWOOD. All Rights Reserved.</span>
        <div class="flex justify-center items-center">
          <IconInstagram class="fill-current text-white mr-5" />
          <IconFacebook class="fill-current text-white mr-5" />
          <IconBrideStory class="fill-current text-white mr-5" />
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {}
</script>
<style></style>
