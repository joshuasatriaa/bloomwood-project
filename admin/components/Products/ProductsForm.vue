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
              <h3 class="mb-3 text-uppercase fw-bold">Main Info</h3>
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

              <BaseInput
                v-model="form.price"
                type="number"
                placeholder="The price of the product"
                form-for="formPrice"
                label="Price (Rp.)"
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
                  :value-consists-of="'LEAF_PRIORITY'"
                  :multiple="true"
                  :options="categories.data"
                  placeholder="Select option..."
                />
              </div>

              <BaseSelect
                v-model="form.size"
                placeholder="The size of the product"
                form-for="formSize"
                label="Size"
                :options="[
                  { id: 'S', value: 'S', label: 'Small' },
                  { id: 'M', value: 'M', label: 'Medium' },
                ]"
                required
              />

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
                    <tr v-for="(image, index) in previewImages" :key="image.id">
                      <td scope="row">
                        <img
                          :src="image.thumbnail_image"
                          width="100"
                          class="mx-3"
                        />
                      </td>
                      <td>
                        <button
                          class="btn btn-danger"
                          @click="deleteProductImage(image.id, index)"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <h3 v-else class="text-danger fw-bold text-center">
                  No image found
                </h3>
              </div>

              <BaseDropzone
                label="Images"
                @newImage="(images) => (form.images = images)"
              />

              <!-- VARIANTS -->
              <hr class="text-primary border border-4" />

              <div>
                <h3 class="mb-3 mt-5 text-uppercase fw-bold">Variants</h3>
                <!-- VARIANTS PREVIEW -->
                <div v-if="isUpdate" class="mb-3">
                  <label for="previewVariants" class="form-label"
                    >Current Available Variants</label
                  >
                  <table
                    v-if="previewVariants.length > 0"
                    class="table table-hover"
                  >
                    <tbody>
                      <tr
                        v-for="(variant, index) in previewVariants"
                        :key="variant.id"
                      >
                        <td scope="row">
                          <img
                            :src="variant.thumbnail_image"
                            width="100"
                            class="mx-3"
                          />
                        </td>
                        <td scope="row">
                          {{ variant.name }}
                        </td>
                        <td scope="row">
                          {{ $currencyFormat(variant.price) }}
                        </td>

                        <td class="text-end">
                          <button
                            class="btn btn-danger"
                            @click="deleteProductVariant(variant.id, index)"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <h3 v-else class="text-danger fw-bold text-center">
                    No variant found
                  </h3>
                </div>
                <!-- PREVIEW END -->
                <div class="col text-end">
                  <button class="btn btn-primary mb-3" @click="moreVariant">
                    Add More Variant
                  </button>
                </div>
                <template>
                  <div v-for="(variant, index) in form.variants" :key="index">
                    <div class="col text-start">
                      <button
                        v-if="index !== 0"
                        class="btn btn-sm btn-danger mb-3"
                        @click="deleteVariant(index)"
                      >
                        Remove Variant Below
                      </button>
                    </div>
                    <BaseInput
                      v-model="variant.name"
                      type="text"
                      placeholder="Variant of the product"
                      form-for="formVariant"
                      :label="`Variant ${index + 1} Name`"
                      required
                    />
                    <BaseInput
                      v-model="variant.price"
                      type="number"
                      placeholder="The price of the variant"
                      form-for="formVariantPrice"
                      label="Price (Rp.)"
                      required
                    />
                    <BaseDropzone
                      :label="`Variant ${index + 1} Image`"
                      :max-images="1"
                      @newImage="
                        (image) => (variant.thumbnail_image = image[0])
                      "
                    />
                  </div>
                </template>
              </div>

              <!-- Add Ons -->
              <hr class="text-primary border border-4" />

              <div>
                <h3 class="mb-3 mt-5 text-uppercase fw-bold">Add Ons</h3>
                <!-- Add Ons PREVIEW -->
                <div v-if="isUpdate" class="mb-3">
                  <label for="previewAddOns" class="form-label"
                    >Current Available Add Ons</label
                  >
                  <table
                    v-if="previewAddOns.length > 0"
                    class="table table-hover"
                  >
                    <tbody>
                      <tr
                        v-for="(addOn, index) in previewAddOns"
                        :key="addOn.id"
                      >
                        <td scope="row">
                          <img
                            :src="addOn.thumbnail_image"
                            width="100"
                            class="mx-3"
                          />
                        </td>
                        <td scope="row">
                          {{ addOn.name }}
                        </td>
                        <td scope="row">
                          {{ $currencyFormat(addOn.price) }}
                        </td>
                        <td class="text-end">
                          <button
                            class="btn btn-danger"
                            @click="deleteProductAddOn(addOn.id, index)"
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <h3 v-else class="text-danger fw-bold text-center">
                    No add on found
                  </h3>
                </div>
                <!-- PREVIEW END -->
                <div class="col text-end">
                  <button class="btn btn-primary mb-3" @click="moreAddOn">
                    Add More Add Ons
                  </button>
                </div>
                <template>
                  <div v-for="(addOn, index) in form.add_ons" :key="index">
                    <div class="col text-start">
                      <button
                        v-if="index !== 0"
                        class="btn btn-sm btn-danger mb-3"
                        @click="deleteAddOn(index)"
                      >
                        Remove Add On Below
                      </button>
                    </div>
                    <BaseInput
                      v-model="addOn.name"
                      type="text"
                      placeholder="Add On of the product"
                      form-for="formAddOn"
                      :label="`Add On ${index + 1} Name`"
                      required
                    />
                    <BaseInput
                      v-model="addOn.price"
                      type="number"
                      placeholder="The price of the add on"
                      form-for="formAddOnPrice"
                      label="Price (Rp.)"
                      required
                    />
                    <BaseDropzone
                      :label="`Add On ${index + 1} Image`"
                      :max-images="1"
                      @newImage="(image) => (addOn.thumbnail_image = image[0])"
                    />
                  </div>
                </template>
              </div>
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
    const {
      form,
      previewImages,
      createProduct,
      updateProduct,
      deleteProductImage,
      moreVariant,
      deleteVariant,
      previewVariants,
      deleteProductVariant,
      moreAddOn,
      deleteAddOn,
      previewAddOns,
      deleteProductAddOn,
    } = useProductForm()
    const { categories } = useGetCategories()

    const initData = (data) => {
      form.name = data.name
      form.description = data.description
      form.price = data.price.toString()
      form.category_ids = data.categories.map((x) => x.id)
      form.size = data.size
      data.images.forEach((x) => {
        previewImages.push(x)
      })
      data.variants.forEach((x) => {
        previewVariants.push(x)
      })
      data.add_ons.forEach((x) => {
        previewAddOns.push(x)
      })
    }

    if (props.isUpdate) {
      initData(props.product.data)
    }

    return {
      form,
      previewImages,
      categories,
      createProduct,
      updateProduct,
      deleteProductImage,
      moreVariant,
      deleteVariant,
      previewVariants,
      deleteProductVariant,
      moreAddOn,
      deleteAddOn,
      previewAddOns,
      deleteProductAddOn,
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
