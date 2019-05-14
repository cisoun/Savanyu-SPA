<template>
  <div id="popup" class="popup popup-close" :style="{ 'display' : visible ? 'block' : 'none' }" @click="close">
    <div class="popup-content animation" @click.stop="">
      <a href="#" class="popup-cross popup-close" @click="close()"></a>
      <img class="popup-image" :src="currentImage ? currentImage.url : ''" />

      <div v-if="showThumbnails">
        <a class="popup-left-arrow" :class="{invisible: !showLeftArrow}" href="#" @click.stop="scrollLeft()"></a>
        <div class="popup-thumbnails" ref="thumbnails" @scroll="updateArrows()">
          <img v-for="image in images" :src="image.url" @mouseover="showImage(image)" />
        </div>
        <a class="popup-right-arrow" :class="{invisible: !showRightArrow}" href="#" @click.stop="scrollRight()"></a>
      </div>

    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'Popup',

  data: () => ({
    currentImage: null,
    images: [],
    showLeftArrow: false,
    showRightArrow: true,
    visible: false,
  }),

  computed: {
    showThumbnails () {
      return this.images.length > 1;
    },

    ...mapGetters({
      artworks: 'artworks/artworks',
      uploads: 'uploads/uploads'
    })
  },

  methods: {
    close () {
      this.$refs.thumbnails.scrollLeft = 0;
      this.$emit('closing');
      this.visible = false;
    },

    scrollLeft () {
      this.$refs.thumbnails.scrollLeft -= 400;
    },

    scrollRight () {
      this.$refs.thumbnails.scrollLeft += 400;
    },

    show (artwork) {
      this.images = this.uploads.filter(upload => upload.artwork_id == artwork.id);

      if (this.images.length > 0) {
        this.currentImage = this.images[0];
      }

      this.$emit('showing');
      this.visible = true;

      this.$nextTick(() => this.updateArrows());
    },

    showImage (image) {
      this.currentImage = image;
    },

    updateArrows () {
      const thumbnails = this.$refs.thumbnails;
      this.showLeftArrow = thumbnails.scrollLeft > 0;
      this.showRightArrow = thumbnails.scrollLeft < thumbnails.scrollWidth - thumbnails.clientWidth;
    },
  }
}
</script>
