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

              <!-- PRODUCT PREVIEW IMAGE -->
              <div v-if="isUpdate" class="mb-3">
                <label for="previewImages" class="form-label"
                  >Current Images</label
                >
                <table
                  v-if="previewImages.length > 0"
                  class="table table-hover"
                >
                  <tbody>
                    <tr v-for="image in previewImages" :key="image.id">
                      <td scope="row">
                        <img
                          :src="image.thumbnail_image"
                          width="100"
                          class="mx-3"
                        />
                      </td>
                      <td><button class="btn btn-danger">Delete</button></td>
                    </tr>
                  </tbody>
                </table>
                <h3 class="text-danger fw-bold text-center">No image found</h3>
              </div>

              <BaseDropzone
                label="Images"
                @newImage="(images) => (form.images = images)"
              />
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-12 col-md-6 mx-auto">
              <button
                class="btn btn-success w-100 text-white"
                @click="!isUpdate ? createProduct() : updateProduct()"
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
import { useProductForm } from '@/composables/useProductForm'
import { useGetCategories } from '@/composables/useCategory'

export default {
  props: {
    isUpdate: {
      type: Boolean,
      default: false,
    },
    product: {
      type: Object,
      default: () => {},
    },
  },
  setup(props) {
    const { form, createProduct, updateProduct } = useProductForm()
    const { categories } = useGetCategories()
    const previewImages = []

    const initData = (data) => {
      form.name = data.name
      form.description = data.description
      form.category_ids = data.categories.map((x) => x.id)
      data.images.forEach((x) => {
        previewImages.push(x)
      })
    }

    if (props.isUpdate) {
      initData(props.product.data)
    }

    return { form, categories, createProduct, previewImages, updateProduct }
  },
}
</script>

<style scoped>
th,
td {
  vertical-align: baseline !important;
}
</style>
