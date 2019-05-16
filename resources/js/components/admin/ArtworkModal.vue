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
      <div v-if="!isVideo" class="form-group">
        <label for="files">{{ $t('management.artworks.files') }}</label>
        <b-form-file id="files" v-model="form.files" :placeholder="$t('management.artworks.choose_files')" multiple></b-form-file>
        <has-error :form="form" field="files"/>
      </div>
      <div v-if="hasVideo" class="form-group">
        <label for="video">{{ $t('video') }}</label>
        <input v-model="form.video" :class="{ 'is-invalid': form.errors.has('video') }" type="text" class="form-control" id="video" :placeholder="$t('management.artworks.video_url')" required>
        <has-error :form="form" field="video"/>
      </div>

      <!--ul class="list-group">
        <draggable v-model="files" @start="drag=true" @end="drag=false">
            <li v-for="file in files" :key="file.id" class="list-group-item"><fa icon="bars" class="handler" /><img :src="file.url" class="img-thumbnail" /></li>
        </draggable>
      </ul-->

      <div v-if="!isVideo && hasFiles" class="card thumbnails">
        <div v-for="(file, index) in files" :key="file.id" class="thumbnail" :style="`background-image:url(${file.url})`">
          <div class="thumbnail-mask"></div>
          <fa icon="times" @click="removeFile(file)"  data-toggle="modal" data-target="#exampleModal"/>
        </div>
      </div>
    </form>
  </b-modal>
</template>

<script>
import Form from 'vform'
import { showErrorsForForm } from '~/plugins/forms'
import { mapGetters } from 'vuex'
//import draggable from 'vuedraggable'

export default {
  name: 'ArtworkModal',

  components: {
    //draggable,
  },

  props: {
    title: { type: String, required: false }
  },

  computed: {
    hasFiles () {
      return this.files.length > 0;
    },

    hasVideo () {
      return this.form.category_id > 2;
    },

    isNew () {
      return this.form.id == 0;
    },

    isVideo () {
      return this.form.category_id == 4;
    },

    thumbnailsColumns () {
      return 4;
    },

    thumbnailsRows () {
      return Math.ceil(this.files.length / this.thumbnailsColumns);
    },

    files () {
      return this.uploads.filter(u => u.artwork_id == this.form.id);
    },

    ...mapGetters({
      categories: 'categories/categories',
      uploads: 'uploads/uploads',
      videos: 'videos/videos'
    })
  },

  data: () => ({
    //files: [],
    form: new Form({
      id: 0,
      title: '',
      description: '',
      text: '',
      category_id: 1,
      files: [],
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
      this.form.description = artwork.description || '';
      this.form.text = artwork.text || '';
      this.form.category_id = artwork.category_id;
      this.form.files = artwork.files;
      this.form.video = '';


      const video = this.videos.find(v => v.artwork_id == artwork.id);
      if (video) {
        this.form.video = 'https://www.youtube.com/watch?v=' + video.url;
      } else {
        //this.files = this.uploads.filter(u => u.artwork_id == artwork.id);
      }

      this.$refs.modal.show();
    },

    getThumbnailsForRow (row) {
      const start = this.thumbnailsRows * row;
      const end = start + this.thumbnailsColumns;
      return this.files.slice(start, end);
    },

    async removeFile (upload) {
      await this.$bvModal.msgBoxConfirm(this.$t('management.artworks.files_delete_confirm'), {
        title: this.$t('management.artworks.files_delete'),
        okVariant: 'danger',
        okTitle: this.$t('delete'),
        cancelTitle: this.$t('cancel'),
        footerClass: 'p-2',
        hideHeaderClose: false,
        centered: true
      })
      .then(async value => {
        if (value) {
          await this.$store.dispatch('uploads/destroy', upload);
        }
      });
    },

    async save () {
      if (this.isNew) {
        await this.store();
      } else {
        await this.update();
      }
    },

    async store () {
      await this.$store.dispatch('artworks/store', this.form.data());
      this.$refs.modal.hide();
    },

    async update () {
      try {
        await this.$store.dispatch('artworks/update', this.form.data());
        this.$refs.modal.hide()
      } catch (e) {
        showErrorsForForm(e, this.form);
      }
    },

    show () {
      this.form.reset();
      this.$refs.modal.show();
    }
  }
}
</script>

<style scoped>
.thumbnails {
  display: grid;
  grid-auto-rows: 1fr;
  grid-column-gap: 0.3rem;
  grid-row-gap: 0.3rem;
  grid-template-columns: repeat(auto-fill, minmax(12rem, 1fr));
}

.thumbnails::before {
  content: '';
  width: 0;
  padding-bottom: 100%;
  grid-row: 1 / 1;
  grid-column: 1 / 1;
}

.thumbnails > *:first-child {
  grid-column: 1 / 1;
  grid-row: 1 / 1;
}

.thumbnail {
  background-position: center;
  background-size: cover;
}

.thumbnail-mask {
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  transition: opacity 0.3s;
  width: 100%;
  height:100%;
}

.thumbnail:hover .thumbnail-mask {
  opacity: 1;
}

.thumbnail svg {
  color: white;
  cursor: pointer;
  display: none;
  font-size: 5rem;
  height: 5rem;
  left: 50%;
  margin-left: -2.5rem;
  margin-top: -2.5rem;
  padding: 1rem;
  position: relative;
  top: -50%;
  width: 5rem;
}

.thumbnail:hover svg {
  display: block;
}

.handler { margin-right: 2rem; }
.list-group-item img {
  height: 2rem;
}
</style>
