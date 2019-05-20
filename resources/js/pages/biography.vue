<template>
<div id="bio" v-html="format(text)">
</div>
</template>

<script>
import { mapGetters } from 'vuex'
import { toTable } from '~/plugins/biography'

export default {
  metaInfo () {
    return { title: 'Biographie' }
  },

  computed: {
    ...mapGetters({
      text: 'biography/text'
    })
  },

  methods: {
    format (text) {
      return toTable(text);
    }
  },

  mounted () {
    this.$store.dispatch('biography/fetch');
  },
}
</script>

<style>
#bio table { border-collapse: collapse; }
#bio table td {
  margin: 0;
  padding: 0;
}
</style>
