<template>
  <div>
    <div class="row">
      <div class="col-6 p-0 pr-2">
        <a class="artwork" v-for="(item, index) in columns[0]" href="#" @click="$parent.$parent.$emit('popup', item)">
          <img :src="getFirstPicture(item)" />
          <div class="title">{{ item.title }}</div>
          <div v-html="fastmd(item.text)"></div>
        </a>
      </div>
      <div class="col-6 p-0 pl-2">
        <a class="artwork" v-for="(item, index) in columns[1]" href="#" @click="$parent.$parent.$emit('popup', item)">
          <img :src="getFirstPicture(item)" />
          <div class="title">{{ item.title }}</div>
          <div v-html="fastmd(item.text)"></div>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import { mixins } from '~/plugins/index'
import { mapGetters } from 'vuex'

export default {
  mixins: [mixins],
  metaInfo () {
    return { title: this.$t('painting') }
  },

  computed: {
    columns () {
      const half = this.artworks.length / 2;

      return [
        this.artworks.slice(0, half),
        this.artworks.slice(half)
      ]
    },

    ...mapGetters({
      artworks: 'artworks/paintings',
      uploads: 'uploads/uploads'
    })
  },

  methods: {
    getFirstPicture (artwork) {
      const uploads = this.uploads.filter(upload => upload.artwork_id == artwork.id);

      if (uploads.length > 0) {
        return uploads[0].url;
      }

      return '';
    },
  }
}
</script>

<style lang="scss" scoped>

.artwork {
  display: block;
  font-size: 0.8em;
  text-align: right;
}

.artwork img {
  width: 100%;
}
</style>
