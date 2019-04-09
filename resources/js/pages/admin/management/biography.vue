<template>
  <div class="card">
    <div class="card-header with-buttons">
      {{ $t('biography') }}
      <button class="btn btn-primary"><fa icon="plus" fixed-width /> {{ $t('section') }}</button>
    </div>
    <div class="card-body">
      <BiographySection v-for="(section, index) in sections" :key="index" :section="section" />
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('biography') }
  },

  computed: {
    ...mapGetters({
      artworks: 'artworks/artworks',
      categories: 'categories/categories'
    })
  },

  data: () => ({
    sections: [
      {
        id: 0,
        title: 'Expositions personnelles',
        events: [
          { date: '2012', title: 'Exposition #1' },
          { date: '2017', title: 'Exposition #2' },
        ]
      },
      {
        id: 1,
        title: 'Expositions collectives',
        events: [
          { date: '2014', title: 'Exposition #1' },
          { date: '2018', title: 'Exposition #2' },
        ]
      }
    ]
  }),

  methods: {

  }
}
</script>

<style scoped>
.card { margin-bottom: 1em; }
.card:last-of-type { margin-bottom: unset }
</style>
