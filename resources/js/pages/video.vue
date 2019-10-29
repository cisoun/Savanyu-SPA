<template>
  <div>
    <div v-for="(item, index) in artworks" class="artwork">
      <Youtube :url="getVideo(item).url" />
      <div class="title">{{ item.title }}</div>
      <div v-html="fastmd(item.text)"></div>
    </div>
  </div>
</template>

<script>
import { mixins } from '~/plugins/index'
import { mapGetters } from 'vuex'

export default {
  mixins: [mixins],
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
  }
}
</script>

<style scoped>
.artwork {
  text-align: right;
}
</style>
