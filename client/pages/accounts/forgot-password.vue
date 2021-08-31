<template>
  <div class="container mx-auto text-primary pt-20">
    <AccountCardContainer
      title="Forgot Password"
      description="please enter your email"
    >
      <form class="flex flex-col" @submit.prevent="submit()">
        <InputText
          id="email"
          v-model="email"
          label="Email Address"
          type="email"
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
            mb-10
          "
        >
          submit
        </button>
      </form>
    </AccountCardContainer>
  </div>
</template>
<script>
export default {
  data() {
    return {
      email: '',
    }
  },
}
</script>
<style></style>
