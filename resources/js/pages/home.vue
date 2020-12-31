<template>
  <div class="text-center home">
    <div v-if="image" class="photo" :style="`background-image: url(${image});`"></div>
    <p v-if="text" class="text mt-3" v-html="format(text)"></p>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  metaInfo () {
    return { title: this.$t('home') }
  },

  computed: {
    ...mapGetters({
      image: 'welcome/image',
      text: 'welcome/text'
    })
  },

  methods: {
    format (text) {
      return text.replace(/\*\*([^(?=\*\*)]+)\*\*/gi, '<b>$1</b>')
                 .replace('\r\n', '<br/>');
    }
  }
}
</script>

<style scoped>
.home {
  display: flex;
  flex-directIon: column;
  height: 700px;
}
.photo {
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
  flex: 1 1 auto;
}
.text { flex: 0 1 auto; }
</style>
