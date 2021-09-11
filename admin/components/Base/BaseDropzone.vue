<template>
  <div class="mb-3">
    <label for="dropzone" class="form-label">{{ label }}</label>
    <Vue2Dropzone
      id="dropzone"
      ref="myVueDropzone"
      :options="dropzoneOptions"
      @vdropzone-file-added="fileAdded"
      @vdropzone-max-files-exceeded="fileExceeded"
      @vdropzone-removed-file="fileRemoved"
    />
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: 'Images',
    },
    maxImages: {
      type: Number,
      default: 5,
    },
  },
  data() {
    return {
      dropzoneOptions: {
        url: 'placeholder',
        thumbnailWidth: 250,
        maxFilesize: 1,
        maxFiles: this.maxImages,
        manuallyAddFile: true,
        autoProcessQueue: false,
        addRemoveLinks: true,
        dictDefaultMessage:
          'Drop images here to upload<br /><span class="text-danger">Max file size 1MB</span>',
      },
      images: [],
    }
  },
  methods: {
    fileAdded(file) {
      if (file.size > 1000000) {
        this.$toast.error('File size is larger than 1MB')
        this.$refs.myVueDropzone.removeFile(file)
        return
      }
      this.images.push(file)
      this.$emit('newImage', this.images)
    },
    fileRemoved(file) {
      this.images.forEach((v, k) => {
        if (v === file) {
          this.images.splice(k, 1)
        }
      })
      this.$emit('newImage', this.images)
    },
    fileExceeded(file) {
      this.$toast.error(`Only ${this.maxImages} images allowed`)
      this.$refs.myVueDropzone.removeFile(file)
    },
  },
}
</script>

<style>
.dz-progress {
  /* progress bar covers file name */
  display: none !important;
}
</style>
