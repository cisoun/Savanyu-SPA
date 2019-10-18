<template>
  <div>
    <div v-for="(item, index) in artworks" class="artwork">
      <Youtube :url="getVideo(item).url" />
      <div class="title">{{ item.title }}</div>
      <div v-html="toHTML(item.text)"></div>
    </div>
  </div>
</template>

<script>
import { toHTML } from '~/plugins/helpers'
import { mapGetters } from 'vuex'

export default {
  metaInfo () {
    return { title: this.$t('video') }
  },

  computed: {
    ...mapGetters({
      artworks: 'artworks/videos',
      videos: 'videos/videos'
    })
  },

  methods: {
    getVideo (artwork) {
      return this.videos.find(v => v.artwork_id == artwork.id);
    },

    toHTML (text) {
      return toHTML(text);
    },
  }
}
</script>

<style scoped>
.artwork {
  text-align: right;
}
</style>
