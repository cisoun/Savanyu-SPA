<template>
  <div class="card">
    <div class="card-header with-buttons">
      <div class="row">
        <div class="col-8 col-sm-11">
          <EditableText v-model="section.title" class="w-100" @changed="changed()" placeholder="Titre de section..."/>
        </div>
        <div class="col-4 col-sm-1">
          <button class="btn btn-danger d-inline-block" @click="remove()"><fa icon="trash" fixed-width /></button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table">
        <tbody>
          <tr v-for="(event, key) in section.events">
            <td><EditableText v-model="event.date" placeholder="Année" /></td>
            <td><EditableTextArea v-model="event.title" /></td>
            <td><button class="btn btn-link d-inline-block" @click="removeEvent(key)"><fa icon="trash" fixed-width /></button></td>
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
      console.log(this.section);
      this.section.events.push({ date: '2019', title: 'test' })
    },

    changed () {
      console.log('changed');
    },

    async remove () {

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
