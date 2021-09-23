<template>
  <div class="container-fluid">
    <h1 class="mb-4">Testimonies</h1>
    <div class="row">
      <div class="col text-end">
        <NuxtLink
          to="/testimonies/create"
          class="btn btn-success text-white mb-4"
          >Add New Testimony</NuxtLink
        >
      </div>
    </div>
    <!-- <BaseSearch :callback="getContactUss" /> -->
    <TestimoniesTable v-if="testimonies" :testimonies="testimonies" />
  </div>
</template>

<script>
import { useGetTestimonies } from '@/composables/useTestimony'
export default {
  middleware: 'auth',
  setup() {
    const { testimonies, getTestimonies } = useGetTestimonies()
    return { testimonies, getTestimonies }
  },
}
</script>

<style></style>
