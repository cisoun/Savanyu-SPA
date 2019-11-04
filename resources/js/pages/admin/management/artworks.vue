<template>
  <div>
    <div class="card">
      <div class="card-header with-buttons">
        {{ $t('artworks') }}
        <button class="btn btn-primary float-right" @click="add()"><fa icon="plus" fixed-width /> {{ $t('add') }}</button>
      </div>
      <div class="card-body">
        <b-table :fields="fields" :items="artworks" striped>

          <!-- Header -->
          <template v-slot:head(title)="data">{{ $t(data.label) }}</template>
          <template v-slot:head(category_id)="data">{{ $t(data.label) }}</template>
          <template v-slot:head(order)="data">{{ $t(data.label) }}</template>
          <template v-slot:head(actions)="data">{{ $t(data.label) }}</template>

          <!-- Body -->
          <template v-slot:cell(id)="data">
            {{ data.item.id }}
          </template>
          <template v-slot:cell(title)="data">
            {{ data.item.title }}
          </template>
          <template v-slot:cell(category_id)="data">
            {{ $t(nameOfCategory(data.value)) }}
          </template>
          <template v-slot:cell(order)="data">
            {{ data.item.order }}
          </template>
          <template v-slot:cell(actions)="data">
            <a href="#" @click="sort(data.item)"><fa icon="sort-amount-up" /></a>
            <a href="#" @click="edit(data.item)"><fa icon="edit" /></a>
            <a href="#" @click="askToRemove(data.item)"><fa icon="times" /></a>
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
  middleware: 'auth',
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
        { key: 'order', label: 'order', sortable: true },
        { key: 'actions', label: 'actions', sortable: false },
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
    },

    async sort (artwork) {
      // Find artwork in the same category that has the biggest value.
      const biggest = Math.max.apply(
        Math, this.artworks.map(function(a) { return a.order; })
      );

      // Put artwork on top.
      artwork.order = biggest + 1;

      await this.$store.dispatch('artworks/update', artwork);
    }
  }
}
</script>
