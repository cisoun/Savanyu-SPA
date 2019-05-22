<template>
  <div>
    <div v-for="(item, index) in artworks">
      <!-- Video -->
      <div v-if="hasVideo(item)" class="row">
        <div class="col-12 text-right">
          <Youtube class="w-100" :url="getVideo(item).url" />
          <div class="title">{{ item.title }}</div>
          {{ item.description }}
        </div>
      </div>

      <!-- Diaporama -->
      <div v-else class="row">
        <div class="col-6">
          <img :src="getFirstPicture(item)" class="img-fluid" />
        </div>
        <div class="col-6">
          <div class="title">{{ item.title }}</div>
          {{ item.text }}
          <a href="#" class="diaporama-link" @click="$parent.$parent.$emit('popup', item)"><fa icon="arrow-right" class="fa-" /> Agrandir <fa icon="arrow-left" /></a>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  metaInfo () {
    return { title: this.$t('sculpture') }
  },

  computed: {
    ...mapGetters({
      artworks: 'artworks/sculptures',
      uploads: 'uploads/uploads',
      videos: 'videos/videos'
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

    getVideo (artwork) {
      return this.videos.find(v => v.artwork_id == artwork.id);
    },

    hasVideo (artwork) {
      return this.getVideo(artwork) != null;
    }
  }
}
</script>

<style scoped>
.row {
  margin-bottom: 30px;
}

.diaporama-link {
  color: var(--primary);
  display: block;
  margin-top: 1rem;
}

.diaporama-link svg {
  stroke: white;
  stroke-width: 40px;
}
.video {
  height: 414px;
}
</style>
