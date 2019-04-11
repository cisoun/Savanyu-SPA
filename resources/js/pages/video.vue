<template>
  <div>
    <div v-for="(item, index) in videos" class="text-right">
      <iframe class="video" :src="getURL(item)" frameborder="0" allowfullscreen></iframe>
      <div class="title">{{ item.title }}</div>
      {{ item.description }}
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  metaInfo () {
    return { title: this.$t('video') }
  },

  data: () => ({
    youtubeUrl: 'https://www.youtube.com/embed/'
  }),

  computed: {
    videos () {
      return this.artworks.filter(a => a.category_id == 4);
    },

    ...mapGetters({
      artworks: 'artworks/artworks',
      videoUrls: 'videos/videos'
    })
  },

  methods: {
    getID (artwork) {
      const video = this.videoUrls.find(v => v.artwork_id == artwork.id);
      if (video) {
        return video.url;
      }
      return '';
    },

    getURL (artwork) {
      const id = this.getID(artwork);
      return this.youtubeUrl + id;
    }
  }
}
</script>

<style lang="scss" scoped>
.video {
  height: 414px;
  width: 740px;
}
</style>
