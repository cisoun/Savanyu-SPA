<template>
  <div class="card">
    <div class="card-header">
      {{ $t('welcome') }}
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="image">Image</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="image">
            <label class="custom-file-label" for="image">Choose file</label>
          </div>
        </div>
        <div class="form-group">
          <label for="text">{{ $t('text') }}</label>
          <textarea id="text" class="form-control" rows="5"></textarea>
        </div>
      </form>



    </div>
  </div>
</template>

<script>
export default {
  layout: 'admin',
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('welcome') }
  },

  computed: {

  }
}
</script>
