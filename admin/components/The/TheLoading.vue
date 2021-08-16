<template>
  <div id="overlay">
    <breeding-rhombus-spinner
      id="loader-element"
      :animation-duration="1300"
      :size="100"
      :color="'#0066a1'"
    />
  </div>
</template>

<script>
import { BreedingRhombusSpinner } from 'epic-spinners'
export default {
  name: 'TheLoading',
  components: {
    BreedingRhombusSpinner,
  },
}
</script>

<style scoped>
#overlay {
  position: fixed; /* Sit on top of the page content */
  display: block; /* Hidden by default */
  width: 100%; /* Full width (cover the whole page) */
  height: 100%; /* Full height (cover the whole page) */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.183); /* Black background with opacity */
  z-index: 9999; /* Specify a stack order in case you're using a different order for other elements */
}
#loader-element {
  position: absolute;
  top: 50%;
  left: 50%;
  color: white;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
}
</style>
