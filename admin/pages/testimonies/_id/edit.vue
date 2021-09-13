<template>
  <div class="container">
    <h1>Edit Testimony</h1>
    <TestimoniesForm
      v-if="testimony.data"
      :is-update="true"
      :testimony="testimony"
    />
  </div>
</template>

<script>
import { useGetTestimony } from '@/composables/useTestimony'
export default {
  middleware: 'auth',
  setup() {
    const { testimony } = useGetTestimony()

    return { testimony }
  },
}
</script>

<style></style>
