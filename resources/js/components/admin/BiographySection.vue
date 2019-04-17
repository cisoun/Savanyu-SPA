<template>
  <div class="card">
    <div class="card-header with-buttons">
      <div class="row">
        <div class="col-8 col-sm-11">
          <EditableText v-model="section.title" class="w-100" @changed="onChange" placeholder="Titre de section..."/>
        </div>
        <div class="col-4 col-sm-1">
          <button class="btn btn-link d-inline-block" @click="remove()"><fa icon="times" fixed-width /></button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table">
        <tbody>
          <tr v-for="(event, key) in section.events">
            <td width="20%"><EditableText v-model="event.date" placeholder="Année" @changed="onEventChange(event)" /></td>
            <td width="70%"><EditableTextArea v-model="event.title" @changed="onEventChange(event)" /></td>
            <td width="10%" class="text-right"><button class="btn btn-link d-inline-block" @click="removeEvent(key)"><fa icon="times" fixed-width /></button></td>
          </tr>
        </tbody>
      </table>
      <button class="btn btn-primary ml-auto mr-auto d-block" @click="add()"><fa icon="plus" fixed-width /> {{ $t('event') }}</button>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'BiographySection',

  props: {
    section: { type: Object, required: true }
  },

  data: () => ({

  }),

  methods: {
    add () {
      const event = {
        id: 0,
        biography_section_id: this.section.id,
        date: String(new Date().getFullYear()),
        title: this.$t('event'),
        section: this.section
      };
      this.section.events.push(event);
      this.$emit('event-create', event);
    },

    onChange (property, value) {
      this.$emit('change', property, value);
    },

    onEventChange (event) {
      this.$emit('event-change', event);
    },

    async remove () {
      this.$emit('remove');
    },

    async removeEvent (event) {
      this.section.events.removeAt(event);
    }
  }
}
</script>

<style scoped>
table tbody tr td:first-child {
    width: 15%;
}
</style>
