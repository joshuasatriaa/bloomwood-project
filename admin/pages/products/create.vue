<template>
  <div class="container">
    <h1>Add New Product</h1>
    <div class="row mt-4">
      <div class="col">
        <div class="card rounded-2 shadow">
          <div class="card-body pb-5">
            <h5 class="card-title">
              <span class="badge bg-success">Create Form</span>
            </h5>
            <div class="row mt-5">
              <div class="col-10 mx-auto">
                <BaseInput
                  v-model="form.name"
                  type="text"
                  placeholder="The name of the product"
                  form-for="formName"
                  label="Name"
                  required
                />
                <BaseTextArea
                  v-model="form.description"
                  placeholder="Description of the product"
                  form-for="formDescription"
                  label="Description"
                  required
                />

                <div class="mb-3">
                  <label for="formCategories" class="form-label"
                    >Categories</label
                  >
                  <TreeSelect
                    v-if="categories.data"
                    v-model="form.category_ids"
                    :disable-branch-nodes="true"
                    :multiple="true"
                    :options="categories.data"
                    placeholder="Select option..."
                  />
                </div>

                <BaseDropzone
                  @newImage="(images) => (form.images = images)"
                  label="Images"
                />
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12 col-md-6 mx-auto">
                <button
                  class="btn btn-success w-100 text-white"
                  @click="createProduct()"
                >
                  CREATE
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from '@nuxtjs/composition-api'
import { useProductForm } from '@/composables/useProductForm'
import { useGetCategories } from '@/composables/useCategory'
export default {
  setup() {
    const { form, createProduct } = useProductForm()
    const { categories } = useGetCategories()

    return { form, categories, createProduct }
  },
}
</script>
