<template>
  <div>

    Biogrphy
  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('artworks') }
  },

  computed: {
    ...mapGetters({
      artworks: 'artworks/artworks',
      categories: 'categories/categories'
    })
  },

  data: () => ({
    fields: [
        // A virtual column that doesn't exist in items
        { key: 'id', label: '#', sortable: true },
        { key: 'title', label: 'title', sortable: true },
        { key: 'category_id', label: 'category', sortable: true },
        { key: 'actions', label: 'actions', sortable: true },
      ],
  }),

  methods: {
    add () {
      this.$refs.artworkModal.show();
    },

    askToRemove (artwork) {
      this.$refs.removeModal.show(artwork.title, artwork);
    },

    edit (artwork) {
      this.$refs.artworkModal.edit(artwork);
    },

    nameOfCategory (id) {
      const category = this.categories.find(c => c.id == id);

      if (!category) {
        return 'undefined';
      }

      return category.name;
    },

    remove (artwork) {
      this.$store.dispatch('artworks/destroy', artwork);
    }
  }
}
</script>
