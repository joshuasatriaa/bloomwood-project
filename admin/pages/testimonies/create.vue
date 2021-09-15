<template>
  <div class="container">
    <h1>Add New Testimony</h1>
    <TestimoniesForm />
  </div>
</template>

<script>
export default {
  middleware: 'auth',
}
</script>
