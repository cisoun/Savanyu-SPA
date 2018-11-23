<template>
  <b-modal ref="modal"
           :title="$t(isNew ? 'management.artworks.add' : 'management.artworks.edit')"
           :cancel-title="$t('cancel')"
           :ok-title="$t('save')"
           :ok-variant="`primary${form.busy ? ' btn-loading' : ''}`"
           @ok.prevent="save()"
           size="lg">
    <form @submit.prevent="save()" @keydown="form.onKeydown($event)">
      <div class="form-group">
        <label for="title">{{ $t('title') }}</label>
        <input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" type="text" class="form-control" id="title" :placeholder="$t('management.artworks.title')" required>
        <has-error :form="form" field="title"/>
      </div>
      <div class="form-group">
        <label for="description">{{ $t('description') }}</label>
        <input v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" type="text" class="form-control" id="description" :placeholder="$t('management.artworks.description')">
        <has-error :form="form" field="description"/>
      </div>
      <div class="form-group">
        <label for="text">{{ $t('text') }}</label>
        <textarea v-model="form.text" :class="{ 'is-invalid': form.errors.has('text') }" class="form-control" id="text" rows="3" :placeholder="$t('management.artworks.text')">{{ form.text }}</textarea>
        <has-error :form="form" field="text"/>
      </div>
      <div class="form-group">
        <label for="category">{{ $t('category') }}</label>
        <select id="category" :class="{ 'is-invalid': form.errors.has('category_id') }" class="custom-select" v-model="form.category_id">
          <option v-for="(category, key) in categories" :value="category.id" :key="key">{{ $t(category.name) }}</option>
        </select>
        <has-error :form="form" field="category_id"/>
      </div>
      <div class="form-group">
        <label for="files">{{ $t('management.artworks.files') }}</label>
        <b-form-file id="files" v-model="form.files" :placeholder="$t('management.artworks.choose_files')" multiple></b-form-file>
        <has-error :form="form" field="files"/>
      </div>
    </form>
  </b-modal>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import { objectToFormData } from '~/plugins/forms'

export default {
  name: 'ArtworkModal',

  props: {
    title: { type: String, required: false }
  },

  computed: {
    isNew () {
      return this.form.id == 0;
    },

    ...mapGetters({
      categories: 'categories/categories'
    })
  },

  data: () => ({
    form: new Form({
      id: 0,
      title: '',
      description: '',
      text: '',
      category_id: 1,
      files: []
    })
  }),

  methods: {
    close () {
      this.form.reset();
      this.$refs.modal.hide();
    },

    edit (artwork) {
      this.form.id = artwork.id;
      this.form.title = artwork.title;
      this.form.description = artwork.description;
      this.form.text = artwork.text;
      this.form.category_id = artwork.category_id;
      this.form.files = artwork.files;

      this.$refs.modal.show();
    },

    async save () {
      if (this.isNew) {
        await this.store();
      } else {
        await this.update();
      }
    },

    async store () {
      const params = {
        transformRequest: [function (data, headers) {
          return objectToFormData(data)
        }],
        headers: { 'Content-Type': 'multipart/form-data' }
      };

      await this.form.submit('post', '/api/artwork/store', params)
                     .then((response) => {
                       this.$store.dispatch('artworks/store', response.data)
                       this.close();
                     })
                     .catch((error) => console.error(error));
    },

    async update () {
      await this.form.patch(`/api/artwork/${this.form.id}`, { headers: {'Content-Type': 'multipart/form-data' }})
                     .then((response) => {
                       this.$store.dispatch('artworks/update', response);
                       this.close();
                     })
                     .catch((error) = {});
    },

    show () {
      this.form.reset();
      this.$refs.modal.show();
    }
  }
}
</script>
