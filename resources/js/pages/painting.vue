<template>
  <div>
    <div class="row">
      <div class="col-6 p-0 pr-2">
        <a class="painting" v-for="(item, index) in columns[0]" href="#" @click="$parent.$parent.$emit('popup', item)">
          <img :src="getFirstPicture(item)" />
          <div class="title">{{ item.title }}</div>
          {{ item.description }}
        </a>
      </div>
      <div class="col-6 p-0 pl-2">
        <a class="painting" v-for="(item, index) in columns[1]" href="#" @click="$parent.$parent.$emit('popup', item)">
          <img :src="getFirstPicture(item)" />
          <div class="title">{{ item.title }}</div>
          {{ item.description }}
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  metaInfo () {
    return { title: this.$t('painting') }
  },

  computed: {
    columns () {
      const half = this.paintings.length / 2;

      return [
        this.paintings.slice(0, half),
        this.paintings.slice(half)
      ]
    },

    paintings () {
      return this.artworks.filter(a => a.category_id == 1);
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

<style lang="scss" scoped>
$padding: 1em;

.painting {
  display: block;
  font-size: 0.8em;
  padding-bottom: $padding;
  text-align: right;
  //width: 334px
}

.painting img {
  padding-bottom: $padding;
  width: 100%;
}
</style>
