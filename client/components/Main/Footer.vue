<template>
  <footer class="bg-brown pt-10 pb-7 font-serif">
    <div class="container mx-auto text-white">
      <p
        class="
          flex flex-col
          items-center
          sm:flex-row sm:justify-evenly
          mb-5
          sm:mb-10
          gap-y-2
        "
      >
        <NuxtLink to="/">About Us</NuxtLink>
        <NuxtLink to="/contact-us">Contact Us</NuxtLink>
        <NuxtLink to="/care-instructions">Care Instruction</NuxtLink>
      </p>
      <div class="flex flex-col items-center mb-10">
        <IconLogo class="transform sm:scale-150 text-center mb-10" />
        <ul class="font-sans font-normal">
          <li>
            <a
              class="flex mb-5"
              href="mailto:bloomwoodflorist@gmail.com"
              rel="noopener noreferrer nofollow"
            >
              <IconEmail class="transform scale-75 mr-5" />
              bloomwoodflorist@gmail.com
            </a>
          </li>
          <li>
            <a
              class="flex mb-5"
              href="https://wa.me/+6287888009807"
              rel="noopener noreferrer nofollow"
              target="_blank"
            >
              <IconWhatsapp class="transform scale-75 mr-5" /> (+62)
              878-8800-9807
            </a>
          </li>
        </ul>
      </div>
      <div class="block text-center lg:flex justify-between">
        <span class="font-normal"
          >Copyright © 2021 BLOOMWOOD. All Rights Reserved.</span
        >
        <div
          class="
            flex flex-col
            gap-y-3
            sm:flex-row
            justify-center
            items-center
            mt-4
            lg:mt-0
          "
        >
          <a
            href="https://www.instagram.com/bloomwoodflorist"
            rel="noopener noreferrer nofollow"
            target="_blank"
            class="flex mr-6"
          >
            <span class="mr-4">Follow Us</span>
            <IconInstagram class="fill-current text-white" />
          </a>
          <a
            href="https://www.tokopedia.com/bloomwoodflorist"
            rel="noopener noreferrer nofollow"
            target="_blank"
            class="flex"
          >
            <span class="mr-4">Also Available on</span>
            <ContainedImage
              src="/tokopedia_icon.png"
              width="22"
              height="22"
              :is-fluid="false"
              class="mr-5"
            />
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {}
</script>
<style></style>
