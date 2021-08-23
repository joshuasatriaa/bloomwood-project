<template>
  <div>
    <h3 class="mb-3 mt-5">Variants</h3>
    <div class="col text-end">
      <button class="btn btn-primary" @click="moreVariant">
        Add More Variant
      </button>
    </div>
    <template>
      <div v-for="(variant, index) in form.variants" :key="index">
        <div class="col text-end">
          <button
            v-if="index != 0"
            class="btn btn-sm btn-danger"
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
        <BaseDropzone
          :label="`Variant ${index + 1} Image`"
          :max-images="1"
          @newImage="(image) => (variant.thumbnail_image = image[0])"
        />
      </div>
    </template>
  </div>
</template>

<script>
import { useProductForm } from '@/composables/useProductForm'

export default {
  setup() {
    const { form, moreVariant, deleteVariant } = useProductForm()
    return {
      form,
      moreVariant,
      deleteVariant,
    }
  },
}
</script>

<style></style>
