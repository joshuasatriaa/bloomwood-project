<template>
  <div class="row mt-4">
    <div class="col">
      <div class="card rounded-2 shadow">
        <div class="card-body pb-5">
          <h5 class="card-title">
            <span class="badge bg-success"
              ><span v-if="!isUpdate">Create</span
              ><span v-else>Update</span> Form</span
            >
          </h5>
          <div class="row mt-5">
            <div class="col-10 mx-auto">
              <BaseInput
                v-model="form.name"
                type="text"
                placeholder="The name of the testimony creator"
                form-for="formName"
                label="Name"
                required
              />

              <BaseTextArea
                v-model="form.message"
                type="text"
                placeholder="The testimony"
                form-for="formTestimony"
                label="Testimony"
                required
              />
              <small
                :class="{
                  'text-danger': charCounter > 240,
                  'text-muted': charCounter <= 240,
                }"
                >*Max 240 characters, current characters:
                {{ charCounter }}</small
              >
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 col-md-6 mx-auto">
              <button
                class="btn btn-success w-100 text-white"
                :disabled="charCounter > 240"
                @click="!isUpdate ? createTestimony() : updateTestimony()"
              >
                <span v-if="!isUpdate">CREATE</span><span v-else>UPDATE</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useTestimonyForm } from '@/composables/useTestimonyForm'
import { computed } from '@nuxtjs/composition-api'

export default {
  name: 'TestimoniesForm',
  props: {
    isUpdate: {
      type: Boolean,
      default: false,
    },
    testimony: {
      type: Object,
      default: () => {},
    },
  },
  setup(props) {
    const { form, createTestimony, updateTestimony } = useTestimonyForm()

    const initData = (data) => {
      form.name = data.name
      form.message = data.message
    }

    if (props.isUpdate) {
      initData(props.testimony.data)
    }

    const charCounter = computed(() => {
      return form.message.length
    })

    return {
      form,
      charCounter,
      createTestimony,
      updateTestimony,
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
