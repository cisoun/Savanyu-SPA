<template>
  <div>
    <div class="card">
      <div class="card-header with-buttons">
        {{ $t('biography') }}
        <button class="btn btn-primary" @click="store"><fa icon="plus" fixed-width /> {{ $t('section') }}</button>
      </div>
      <div class="card-body">
        <BiographySection v-for="(section, index) in sections"
          :key="index"
          :section="section"
          @change="onSectionChange"
          @event-change="onEventChange"
          @event-create="onEventCreate"
          @remove="onSectionRemove(section)" />
      </div>
    </div>

    <RemoveModal ref="removeModal" v-on:confirm="remove" :title="$t('management.biography_section.delete')" />
  </div>
</template>

<script>
import axios from 'axios'
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
    sections: []
  }),

  methods: {
    async load () {
      await axios.get('/api/biography/section/index')
                 .then(response => this.sections = response.data)
                 .catch(error => console.error(error));
    },

    async remove (section) {
      await axios.delete(`/api/biography/section/${section.id}`)
                 .then(response => this.sections.remove(section))
                 .catch(error => console.error(error));
    },

    async store () {
      const title = this.generateTitle();
      const section = { 'title': title };

      await axios.post('/api/biography/section/store', section)
                 .then(response => this.sections.push(response.data))
                 .catch(error => console.error(error));
    },

    generateTitle () {
      const prefix = 'Section ';
      let title = prefix;
      let i = 1;

      do {
        title = prefix + i++;
      } while (this.sections.filter(s => s.title == title).length > 0);

      return title;
    },

    onEventChange (event) {

    },

    async onEventCreate (event) {
      await this.store();
      // await axios.post('/api/biography/event/store', event)
      //            .then(response => event = response.data)
      //            .catch(error => console.error(error));
    },

    onSectionChange (property, value) {
      console.log(property);
      console.log(value);
    },

    onSectionRemove (section) {
      this.$refs.removeModal.show(section.title, section);
    }
  },

  async mounted () {
    await this.load();
  }
}
</script>

<style scoped>
.card { margin-bottom: 1em; }
.card:last-of-type { margin-bottom: unset }
</style>
