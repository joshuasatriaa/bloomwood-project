<template>
  <div class="container mx-auto font-bold text-primary pt-20">
    <div class="flex flex-col justify-center items-center">
      <div>
        <span>say hi to our team</span>
        <h1 class="text-5xl sm:text-6xl md:text-8xl mb-10">Contact Us</h1>
        <p class="text-xl mx-auto mb-16" style="max-width: 22ch">
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
            label="Name"
            type="text"
            class="mb-7"
          />
          <InputText
            id="email"
            v-model="form.email"
            label="Email Address"
            type="email"
            class="mb-7"
          />
          <InputText
            id="phone-number"
            v-model="form.phoneNumber"
            label="Phone Number"
            type="tel"
            class="mb-7"
          />
          <InputText
            id="how-did-you-find"
            v-model="form.howDidYouFind"
            label="How did you find bloomwood"
            type="text"
            class="mb-7"
          />
          <InputText
            id="message"
            v-model="form.message"
            label="How can we help you"
            type="text"
            class="mb-7"
          />
          <button
            type="submit"
            class="
              w-full
              bg-primary
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
      <h1 class="text-6xl sm:text-6xl md:text-7xl text-primary mb-10 md:mb-20">
        Find Us
      </h1>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16">
        <div class="self-center">
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
          <h2 class="text-2xl lg:text-3xl xl:text-4xl font-bold mb-8">
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
          >
            Jalan Jenderal Sudirman Nomor 32, Kebon Jeruk, Jakarta Barat,
            Jakarta Barat 14400
          </p>
          <h2 class="text-2xl lg:text-3xl xl:text-4xl font-bold mb-8">
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
          >
            Monday - Friday 10:00 - 18:00 WIB
            <br />
            Saturday - Sunday 11:00 - 19:00 WIB
          </p>
        </div>
      </div>
    </div>
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
    submit() {
      console.log('submit')
    },
  },
}
</script>
<style></style>
