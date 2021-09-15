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
              <div v-if="!isUpdate" class="mb-3">
                <BaseCheckbox
                  v-model="form.isParent"
                  :class="{ disabled: isUpdate }"
                  label="Is Parent"
                  form-for="formIsParent"
                  :disabled="isUpdate"
                />
              </div>

              <div v-if="isUpdate && form.isParent">
                <h5 class="badge bg-primary">Parent Category</h5>
              </div>

              <BaseInput
                v-model="form.name"
                type="text"
                placeholder="The name of the category"
                form-for="formName"
                label="Name"
                required
              />

              <div v-if="isUpdate && form.isParent" class="my-3">
                <p>Current Image</p>
                <img :src="category.data.thumbnail_image" alt="" srcset="" />
              </div>
              <div v-if="form.isParent">
                <BaseDropzone
                  label="Parent Category Image"
                  :max-images="1"
                  @newImage="(image) => (form.thumbnail_image = image)"
                />
              </div>

              <div v-if="!form.isParent" class="mb-3">
                <label for="formCategories" class="form-label"
                  >Parent Category</label
                >
                <TreeSelect
                  v-if="categories.data"
                  v-model="form.parent_id"
                  :disable-branch-nodes="false"
                  :value-consists-of="'BRANCH_PRIORITY'"
                  :multiple="false"
                  :options="disabledSubCategories"
                  :disabled="form.isParent"
                  placeholder="Select option..."
                />
              </div>
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
import { useGetCategories } from '@/composables/useCategory'

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
    const { categories } = useGetCategories(true)

    const initData = (data) => {
      form.name = data.name
      form.parent_id = data.parent_id
      if (data.parent_id) {
        form.isParent = false
      } else {
        form.isParent = true
      }
    }

    if (props.isUpdate) {
      initData(props.category.data)
    }

    return {
      form,
      categories,
      createCategory,
      updateCategory,
    }
  },
  watch: {
    'form.isParent'() {
      this.form.parent_id = null
    },
  },
  computed: {
    disabledSubCategories() {
      if (!this.categories.data) {
        return []
      }

      const cats = this.categories.data

      for (const i of cats) {
        delete i.children
      }

      return cats
    },
  },
}
</script>

<style scoped>
th,
td {
  vertical-align: baseline !important;
}
</style>
