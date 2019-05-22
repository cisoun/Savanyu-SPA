<template>
  <div class="card">
    <div class="card-header with-buttons">
      {{ $t('welcome') }}
      <button class="btn btn-primary float-right" :class="{'btn-loading': busy}" @click="update()">
        <fa :icon="updated ? 'check' : 'pen'" fixed-width /> {{ $t('update') }}
      </button>
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
          <b-textarea id="text" rows="5" v-model="$store.state.welcome.text"></b-textarea>
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
    updated: false,
  }),

  methods: {
    onFileChange () {
      this.file = this.$refs.image.files[0];
    },

    async update () {
      this.busy = true;

      await this.$store.dispatch('welcome/update', {
        file: this.$refs.image.files[0],
        text: this.$store.state.welcome.text
      })
      .then(() => this.updated = true)
      .catch(() => this.updated = false)
      .finally(() => this.busy = false);
    }
  }
}
</script>
