<template>
  <div class="table-responsive">
    <table v-if="contactUs.data" class="table table-striped table-hover">
      <thead class="">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Found At</th>
          <th scope="col">Created At</th>
          <th scope="col" class="text-end"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(contact, index) in contactUs.data" :key="contact.id">
          <td>
            {{ index + 1 }}
          </td>
          <td>
            {{ contact.name }}
          </td>
          <td class="text-nowrap">{{ contact.email }}</td>
          <td>{{ contact.phone }}</td>
          <td>{{ contact.found_bloomwood }}</td>
          <td>{{ contact.created_at }}</td>
          <td class="text-end text-nowrap">
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#modalMessage"
              @click="currentMessage = contact.message"
            >
              View Message
            </button>
          </td>
        </tr>
        <tr v-if="!contactUs.data.length">
          <td colspan="6" class="text-center">
            <span class="text-danger fw-bold">Data not found.</span>
          </td>
        </tr>
      </tbody>
    </table>
    <div
      class="modal fade"
      id="modalMessage"
      tabindex="-1"
      aria-labelledby="modalMessageLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalMessageLabel">Message</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">{{ currentMessage }}</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ContactUsTable',
  props: {
    contactUs: {
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      currentMessage: '',
    }
  },
}
</script>

<style scoped>
th,
td {
  vertical-align: baseline !important;
}
</style>
