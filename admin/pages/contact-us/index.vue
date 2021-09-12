<template>
  <div class="container-fluid">
    <h1 class="mb-4">Contact Us Messages</h1>

    <!-- <BaseSearch :callback="getContactUss" /> -->
    <ContactUsTable v-if="contactUss" :contact-us="contactUss" />
    <div class="col-12 col-md-6 d-flex justify-content-end ms-auto">
      <BasePagination
        getter="contactUs/CONTACT_USS"
        action="contactUs/GET_CONTACT_USS"
      />
    </div>
  </div>
</template>

<script>
import { useGetContactUss } from '@/composables/useContactUs'
export default {
  middleware: 'auth',
  setup() {
    const { contactUss, getContactUss } = useGetContactUss()
    return { contactUss, getContactUss }
  },
}
</script>

<style></style>
