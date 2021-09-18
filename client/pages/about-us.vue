<template>
  <div class="container mx-auto text-primary pt-20 font-sans">
    <div class="grid grid-col-1 lg:grid-cols-2 gap-x-16 items-center">
      <div class="lg:ml-14">
        <h1
          class="text-5xl sm:text-6xl md:text-7xl text-primary mb-20 font-serif"
          data-aos="fade-right"
        >
          About Us
        </h1>
        <div
          class="
            ml-4
            mb-20
            pl-5
            md:pl-9
            border-primary
            font-medium
            text-lg
            border-l-4
          "
          data-aos="fade-right"
          data-aos-delay="300"
        >
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
          quis hendrerit dolor. Praesent nibh justo, efficitur vel ultrices
          eget, efficitur eu dolor. Maecenas porttitor mi eros, at pellentesque
          lacus consequat non. Praesent aliquet varius libero sit amet mollis.
          Sed at ligula eu diam vehicula lobortis eu et diam. Duis cursus tempor
          lacus, id vehicula massa maximus sed. Mauris dignissim, elit ut
          ullamcorper placerat, massa arcu sagittis enim, vulputate facilisis
          orci dolor quis augue. Aenean accumsan erat eu est lacinia, lobortis
          tincidunt erat aliquet. Nulla aliquam blandit sapien, ut accumsan orci
          aliquet in.
        </div>
      </div>
      <div class="flex items-center" data-aos="fade-left">
        <ContainedImage
          width="731"
          height="479"
          style="height: 479px"
          :is-fluid="false"
          src="/pink-roses.jfif"
          alt=""
          class="clip-about-us"
        />
        <svg
          width="100%"
          height="100"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <clipPath
            id="clipAboutUs"
            clipPathUnits="objectBoundingBox"
            transform="scale(0.00136798905, 0.00208768267)"
          >
            <rect y="3" width="148" height="421" fill="#C4C4C4" />
            <rect x="190" y="47" width="155" height="437" fill="#C4C4C4" />
            <rect x="386" width="151" height="424" fill="#C4C4C4" />
            <rect x="579" y="48" width="154" height="436" fill="#C4C4C4" />
          </clipPath>
        </svg>
      </div>
    </div>
  </div>
</template>
<script>
export default {}
</script>
<style>
.clip-about-us {
  clip-path: url(#clipAboutUs);
  @apply object-cover;
}
</style>
