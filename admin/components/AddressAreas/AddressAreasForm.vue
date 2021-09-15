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

          <div class="row mt-3">
            <div class="col-10 mx-auto">
              <BaseInput
                v-model="form.name"
                type="text"
                placeholder="The Area Name"
                form-for="formAddressName"
                label="Name"
                required
              />
              <BaseInput
                v-model="form.description"
                type="text"
                placeholder="The description of the area"
                form-for="formAddressDescription"
                label="Description"
                required
              />
              <BaseInput
                v-model="form.small_price"
                type="number"
                placeholder="The small price"
                form-for="formSmallPrice"
                label="Small Price (Rp.)"
                required
              />
              <BaseInput
                v-model="form.medium_price"
                type="number"
                placeholder="The medium price"
                form-for="formMediumPrice"
                label="Medium Price (Rp.)"
                required
              />
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 col-md-6 mx-auto">
              <button
                class="btn btn-success w-100 text-white"
                @click="!isUpdate ? createAddressArea() : updateAddressArea()"
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
import { useAddressAreaForm } from '@/composables/useAddressAreaForm'

export default {
  props: {
    isUpdate: {
      type: Boolean,
      default: false,
    },
    addressArea: {
      type: Object,
      default: () => {},
    },
  },
  setup(props) {
    const { form, updateAddressArea, createAddressArea } = useAddressAreaForm()

    const initData = (data) => {
      form.name = data.name
      form.description = data.description
      form.small_price = data.small_price
      form.medium_price = data.medium_price
    }

    if (props.isUpdate) {
      initData(props.addressArea.data)
    }

    return {
      form,
      updateAddressArea,
      createAddressArea,
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
