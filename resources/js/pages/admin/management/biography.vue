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
        title: 'Test',
        events: [
          { date: '2012', title: 'Restauration hard mode\nLe ramoulox est réesl.' },
          { date: '2017', title: 'La bamboula fut froide mais conscise' },
        ]
      },
      {
        id: 1,
        title: 'La bamba',
        events: [
          { date: '2014', title: 'Jamais deux sans trois' },
          { date: '2018', title: 'Toujours 203' },
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
