<template>
  <BiographyTable v-bind:text="text" />
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  metaInfo () {
    return { title: this.$t('biography') }
  },

  computed: {
    ...mapGetters({
      text: 'biography/text'
    })
  },

  mounted () {
    this.$store.dispatch('biography/fetch');
  },
}
</script>
