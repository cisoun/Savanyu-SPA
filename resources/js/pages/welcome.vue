<template>
  <div class="text-center">
    <img :src="`${image}`" alt="Image" />
    <p class="mt-3" v-html="format(text)"></p>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('home') }
  },

  computed: {
    ...mapGetters({
      image: 'welcome/image',
      text: 'welcome/text'
    })
  },

  mounted () {
    this.$store.dispatch('welcome/fetch');
  },

  methods: {
    format (text) {
      return text.replace(/\*\*([^(?=\*\*)]+)\*\*/gi, '<b>$1</b>')
                 .replace('\r\n', '<br/>');
    }
  }
}
</script>
