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
              py-4
              rounded-md
            "
          >
            send message
          </button>
        </form>
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
