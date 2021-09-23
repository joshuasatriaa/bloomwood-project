<template>
  <div class="container mx-auto font-bold text-primary pt-20">
    <div class="flex flex-col justify-center items-center">
      <div>
        <span class="font-semibold">say hi to our team</span>
        <h1 class="text-5xl sm:text-6xl md:text-8xl mb-10 font-serif">
          Contact Us
        </h1>
        <p class="text-xl mx-auto mb-16 max-w-[22ch] font-semibold">
          reach us for any questions you might have
        </p>
        <!-- <input
          type="text"
          placeholder="name"
          class="w-full pb-3 focus:outline-none border-b-4 focus:border-primary"
        /> -->
        <form @submit.prevent="submit()">
          <InputText
            id="name"
            v-model="form.name"
            label="name"
            type="text"
            class="mb-7"
          />
          <InputText
            id="email"
            v-model="form.email"
            label="email address"
            type="email"
            class="mb-7"
          />
          <InputText
            id="phone-number"
            v-model="form.phoneNumber"
            type="tel"
            pattern="\d{8,13}"
            label="phone number (ex.081234567890)"
            class="mb-7"
          />
          <InputText
            id="how-did-you-find"
            v-model="form.howDidYouFind"
            label="how did you find bloomwood"
            type="text"
            class="mb-7"
          />
          <InputText
            id="message"
            v-model="form.message"
            label="how can we help you"
            type="text"
            class="mb-7"
          />
          <button
            type="submit"
            class="
              w-full
              bg-secondary
              font-bold
              text-lg text-white
              py-3
              rounded-md
            "
          >
            send message
          </button>
        </form>
      </div>
    </div>

    <div class="md:ml-14 mt-24">
      <h1
        class="
          text-6xl
          sm:text-6xl
          md:text-7xl
          text-primary
          mb-10
          md:mb-20
          font-serif
        "
      >
        Find Us
      </h1>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16">
        <div class="self-center" data-aos="fade-up">
          <div
            class="
              border-4 border-primary
              rounded-lg
              aspect-w-40 aspect-h-27
              relative
            "
          >
            <iframe
              class="rounded w-full h-full"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14870.317741588633!2d106.76151294983356!3d-6.106555886267865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69edc0e6940113%3A0xf082213377c53ac1!2sBloomwood%20Florist!5e0!3m2!1sen!2sid!4v1630473156108!5m2!1sen!2sid"
              allowfullscreen=""
              loading="lazy"
            />
          </div>
        </div>
        <div class="text-primary mt-7 lg:mt-0 xl:mt-7">
          <h2
            class="text-2xl lg:text-3xl xl:text-4xl font-semibold mb-8"
            data-aos="fade-up"
          >
            The Location
          </h2>
          <p
            class="
              text-lg
              lg:text-xl
              xl:text-2xl
              ml-7
              pl-8
              border-l-4 border-primary
              mb-10
              font-normal
            "
            data-aos="fade-up"
            data-aos-delay="300"
          >
            Galeri Niaga Mediterania II, Ruko Gallery, Blk. L No.8 H,
            RT.1/RW.16, Kapuk Muara, Jakarta, Kota Jkt Utara, Daerah Khusus
            Ibukota Jakarta 14460
          </p>
          <h2
            class="text-2xl lg:text-3xl xl:text-4xl font-semibold mb-8"
            data-aos="fade-up"
          >
            Opening Hours
          </h2>
          <p
            class="
              text-lg
              lg:text-xl
              xl:text-2xl
              ml-7
              pl-8
              border-l-4 border-primary
              font-normal
            "
            data-aos="fade-up"
            data-aos-delay="300"
          >
            Monday - Saturday 08:30 - 17:30 WIB
            <br />
            Sunday Close
          </p>
        </div>
      </div>
    </div>
    <ModalContainer
      id="modal-contact-us"
      title="Thank you"
      desc="our team will contact you soon"
      btn-proceed-title="back to home"
      :btn-proceed-callback="() => $router.push('/')"
    />
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        phoneNumber: '',
        howDidYouFind: '',
        message: '',
      },
    }
  },
  methods: {
    async submit() {
      try {
        await this.$axios.$post('/api/contact-us', {
          name: this.form.name,
          email: this.form.email,
          phone: this.form.phoneNumber,
          found_bloomwood: this.form.howDidYouFind,
          message: this.form.message,
        })
        this.$modal.show('modal-contact-us')
      } catch (e) {
        console.log(e)
      }
    },
  },
}
</script>
<style></style>
