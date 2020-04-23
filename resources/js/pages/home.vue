<template>
  <div class="text-center">
    <img v-if="image" :src="`${image}`" alt="Image" />
    <p v-if="text" class="mt-3" v-html="format(text)"></p>
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
  img {
    max-height: 700px;
  }
</style>
