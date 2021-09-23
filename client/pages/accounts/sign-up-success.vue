<template>
  <div class="container mx-auto text-primary pt-20">
    <AccountCardContainer
      title="Sign Up Success"
      description="account has been created, please login to your account"
      margin-type="compact"
    >
      <div class="flex">
        <NuxtLink
          to="/accounts/login"
          class="
            w-full
            text-center
            bg-primary
            font-bold
            text-lg text-white
            py-3
            rounded-md
            mb-8
          "
        >
          login
        </NuxtLink>
      </div>
    </AccountCardContainer>
  </div>
</template>
<script>
export default {
  name: 'SignUpSuccess',
  middleware: 'auth',
  auth: 'guest',
}
</script>
<style></style>
