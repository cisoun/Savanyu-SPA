<template>
  <div>
    <div v-for="(item, index) in artworks" class="artwork">
      <Youtube :src="getVideo(item).url" />
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
