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
                placeholder="The name of the category"
                form-for="formName"
                label="Name"
                required
              />
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 col-md-6 mx-auto">
              <button
                class="btn btn-success w-100 text-white"
                @click="!isUpdate ? createCategory() : updateCategory()"
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
import { useCategoryForm } from '@/composables/useCategoryForm'

export default {
  props: {
    isUpdate: {
      type: Boolean,
      default: false,
    },
    category: {
      type: Object,
      default: () => {},
    },
  },
  setup(props) {
    const { form, createCategory, updateCategory } = useCategoryForm()

    const initData = (data) => {
      form.name = data.name
    }

    if (props.isUpdate) {
      initData(props.category.data)
    }

    return {
      form,
      createCategory,
      updateCategory,
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
