<template>
  <div class="card">
    <div class="card-header with-buttons">
      {{ $t('welcome') }}
      <button class="btn btn-primary float-right" :class="{'btn-loading': busy}" @click="save()"><fa icon="save" fixed-width /> {{ $t('save') }}</button>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="image">{{ $t('image') }}</label>
          <div class="custom-file">
            <input ref="image" type="file" class="custom-file-input" id="image" accept="image/*" @change="onFileChange">
            <label ref="imageTitle" class="custom-file-label" for="image">{{ file ? file.name : '' }}</label>
          </div>
        </div>
        <div class="form-group">
          <label for="text">{{ $t('text') }}</label>
          <textarea ref="text" id="text" class="form-control" rows="5" v-model="text"></textarea>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  layout: 'admin',
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('welcome') }
  },

  data: () => ({
    busy: false,
    file: null,
    text: ''
  }),

  methods: {
    onFileChange () {
      this.file = this.$refs.image.files[0];
    },

    async save () {
      this.busy = true;

      const formData = new FormData();
      formData.append('file', this.$refs.image.files[0]);
      formData.append('text', this.text);

      await axios.post( '/api/welcome', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(() => {

      }).catch(() => {

      }).finally(() => {
        this.busy = false;
      });
    }
  }
}
</script>
