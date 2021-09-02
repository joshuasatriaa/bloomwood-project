<template>
  <div>
    <div>cart</div>
    <NuxtLink to="/cart/shipment">go to shipment</NuxtLink>
  </div>
</template>
<script>
export default {
  name: 'Cart',
  middleware: 'auth',
}
</script>
<style></style>
