<template>
  <div>
    <div v-for="(item, index) in sculptures" class="row">
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
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  metaInfo () {
    return { title: this.$t('sculpture') }
  },

  computed: {
    sculptures () {
      return this.artworks.filter(a => a.category_id == 3);
    },

    ...mapGetters({
      artworks: 'artworks/artworks',
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
</style>
