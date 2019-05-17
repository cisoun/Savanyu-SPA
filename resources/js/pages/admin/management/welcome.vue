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
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('welcome') }
  },

  computed: {
    ...mapGetters({
      image: 'welcome/image',
    }),
  },

  data: () => ({
    busy: false,
    file: null,
    text: ''
  }),

  async mounted () {
    await this.$store.dispatch('welcome/fetch');
    this.text = this.$store.getters['welcome/text'];
  },

  methods: {
    onFileChange () {
      this.file = this.$refs.image.files[0];
    },

    async save () {
      this.busy = true;

      this.$store.dispatch('welcome/update', {
        file: this.$refs.image.files[0],
        text: this.text
      }).then(() => this.busy = false);
    }
  }
}
</script>
