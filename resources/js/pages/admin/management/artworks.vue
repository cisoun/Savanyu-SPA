<template>
  <div>
    <div class="card">
      <div class="card-header with-buttons">
        {{ $t('artworks') }}
        <button class="btn btn-primary float-right" @click="add()"><fa icon="plus" fixed-width /> Ajouter</button>
      </div>
      <div class="card-body">
        <b-table :fields="fields" :items="artworks" striped>

          <template slot="HEAD_title" slot-scope="data">{{ $t(data.label) }}</template>
          <template slot="HEAD_category_id" slot-scope="data">{{ $t(data.label) }}</template>

          <template slot="id" slot-scope="data">
            {{ data.item.id }}
          </template>

          <template slot="title" slot-scope="data">
            {{ data.item.title }}
          </template>

          <template slot="category_id" slot-scope="data">
            {{ $t(nameOfCategory(data.value)) }}
          </template>

          <template slot="actions" slot-scope="data">
            <a href="#" @click="edit(data.item)"><fa icon="edit" /></a>
            <a href="#" @click="askToRemove(data.item)"><fa icon="trash" /></a>
          </template>

        </b-table>

      </div>
    </div>

    <ArtworkModal ref="artworkModal" />
    <RemoveModal ref="removeModal" v-on:confirm="remove" :title="$t('management.artworks.delete')" />

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
