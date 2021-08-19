<template>
  <div class="row mt-4">
    <div class="col-12 col-lg-6 ms-auto">
      <form class="d-flex mb-3">
        <input
          v-model="search"
          class="form-control me-2"
          type="search"
          placeholder="Search ..."
          aria-label="Search ..."
        />
      </form>
    </div>
  </div>
</template>

<script>
import { debounce } from '@/helpers/debounce'
export default {
  name: 'BaseSearch',
  props: {
    callback: {
      type: Function,
      required: true,
    },
  },
  data() {
    return {
      search: '',
    }
  },
  watch: {
    search: debounce(function () {
      this.callback(this.search)
    }, 500),
  },
}
</script>

<style></style>
