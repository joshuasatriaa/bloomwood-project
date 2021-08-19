<template>
  <nav v-if="getMeta" aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item" :class="{ disabled: !getLinks.prev }">
        <button
          class="page-link"
          :disabled="!getLinks.prev"
          @click="handleClick('prev')"
        >
          Prev
        </button>
      </li>
      <select
        v-model="selectedPage"
        class="form-select mx-2"
        aria-label="Page Selection"
      >
        <option value="0" disabled>Select Page</option>
        <option v-for="option in lastPage" :key="option" :value="option">
          {{ option }}
        </option>
      </select>
      <li class="page-item" :class="{ disabled: !getLinks.next }">
        <button
          class="page-link"
          :disabled="!getLinks.next"
          @click="handleClick('next')"
        >
          Next
        </button>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: 'BasePagination',
  props: {
    getter: {
      type: String,
      required: true,
    },
    action: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      selectedPage: 1,
    }
  },
  computed: {
    getMeta() {
      return this.$store.getters[`${this.getter}`].meta ?? {}
    },
    getLinks() {
      return this.$store.getters[`${this.getter}`].links ?? {}
    },
    currentPage() {
      return this.getMeta.current_page
    },
    lastPage() {
      return this.getMeta.last_page
    },
  },
  watch: {
    currentPage() {
      this.selectedPage = this.currentPage
    },
    selectedPage() {
      this.fireAction()
    },
  },
  methods: {
    async fireAction() {
      const payload = {
        page: this.selectedPage,
      }

      this.$scrollTo('#the-navbar')
      const [_, error] = await this.$async(
        this.$store.dispatch(`${this.action}`, payload)
      )
      if (error) {
        this.$errorHandler(error)
        return
      }
      this.$successHandler('Page changed!')
    },
    handleClick(direction) {
      switch (direction) {
        case 'prev':
          if (this.getLinks.prev) {
            this.selectedPage -= 1
          }
          break
        case 'next':
          if (this.getLinks.next) {
            this.selectedPage += 1
          }
          break
        default:
          break
      }
    },
  },
}
</script>
<style></style>
