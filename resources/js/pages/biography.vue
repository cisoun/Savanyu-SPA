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
  }
}
</script>
