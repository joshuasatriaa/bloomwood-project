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
                placeholder="The name of the group"
                form-for="formName"
                label="Name"
                required
              />

              <div class="mb-3">
                <label for="formCategories" class="form-label"
                  >Categories</label
                >
                <TreeSelect
                  v-if="categories.data"
                  v-model="form.category_ids"
                  :disable-branch-nodes="false"
                  :value-consists-of="'BRANCH_PRIORITY'"
                  :multiple="true"
                  :options="disabledSubCategories"
                  placeholder="Select option..."
                />
                <p class="text-primary mt-2">
                  Categories selected will be attached to
                  <span class="fw-bold">{{ form.name ? form.name : '-' }}</span>
                  group
                </p>
              </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 col-md-6 mx-auto">
              <button
                class="btn btn-success w-100 text-white"
                @click="
                  !isUpdate ? createNavigationGroup() : updateNavigationGroup()
                "
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
import { useNavigationGroupForm } from '@/composables/useNavigationGroupForm'
import { useGetCategories } from '@/composables/useCategory'
import { toRef } from '@vue/composition-api'

export default {
  props: {
    isUpdate: {
      type: Boolean,
      default: false,
    },
    navigationGroup: {
      type: Object,
      default: () => {},
    },
  },
  setup(props) {
    const { form, createNavigationGroup, updateNavigationGroup } =
      useNavigationGroupForm()

    const { categories } = useGetCategories(true)

    const initData = (data) => {
      form.name = data.name
      form.category_ids = []
      data.categories.forEach((x) => form.category_ids.push(x.id))
    }

    if (props.isUpdate) {
      initData(props.navigationGroup.data)
    }

    return {
      form,
      createNavigationGroup,
      updateNavigationGroup,
      categories,
    }
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
