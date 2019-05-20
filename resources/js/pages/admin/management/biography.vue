<template>
  <div>
    <div class="card">
      <div class="card-header with-buttons">
        {{ $t('biography') }}
        <button class="btn btn-primary" :class="{'btn-loading': busy}" @click="update()"><fa icon="pen" fixed-width /> {{ $t('update') }}</button>
      </div>

      <div class="card-body">
        <b-card no-body>
          <b-tabs card>
            <b-tab :title="$t('code')">
              <template slot="title">
                <fa icon="code" /> {{ $t('code') }}
              </template>
              <b-form-textarea
              rows="20"
              v-model="text"
              @keydown.tab.prevent="tabber($event)">
            </b-form-textarea>
          </b-tab>
          <b-tab :title="$t('preview')" v-html="format(text)">
            <template slot="title">
              <fa icon="eye" /> {{ $t('preview') }}
            </template>
          </b-tab>
          <b-tab>
            <template slot="title">
              <fa icon="question-circle" /> Aide
            </template>
            <h3>Aide pour la rédaction</h3>
            <h5>Section</h5>
            <p>Le titre d'une section n'a pas de contrainte particulière.</p>
            <h5>Événement</h5>
            <p>Un événement s'écrit de la manière suivante :</p>
            <p>
              <ul>
                <li>Année (si plusieurs, séparées par une virgule)</li>
                <li>Tabulation</li>
                <li>Titre de lévénement</li>
              </ul>
            </p>
            <h5>Exemple</h5>
            <p>
              <b-card class="text-left">
                <code>
                  Mes expositions<br><br>
                  2019<b-badge variant="light">tab</b-badge>Exposition 2019<br>
                  2001, 2002<b-badge variant="light">tab</b-badge>Expositions
                </code>
              </b-card>
            </p>
            <p>Ce qui donne :</p>
            <p>
              <b-card class="text-left">
                <div v-html="format(example)"></div>
              </b-card>
            </p>
          </b-tab>
        </b-tabs>
      </b-card>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios'
import Form from 'vform'
import { mapGetters } from 'vuex'
import { toTable } from '~/plugins/biography'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('biography') }
  },

  data: () => ({
    busy: false,
    example: 'Mes expositions\n2019\tExposition 2019\n2001, 2002\tExpositions',
    text: ''
  }),

  methods: {
    format (text) {
      return toTable(text);
    },

    tabber (event) {
      if (event) {
        event.preventDefault();
        let text = event.target.value;
        let startText = text.slice(0, event.target.selectionStart);
        let endText = text.slice(event.target.selectionStart);
        event.target.value = `${startText}\t${endText}`
        event.target.selectionEnd = event.target.selectionStart + 1
      }
    },

    async update () {
      this.busy = true;

      this.$store.dispatch('biography/update', {
        text: this.text
      }).finally(() => this.busy = false);
    },
  },

  async mounted () {
    await this.$store.dispatch('biography/fetch');
    this.text = this.$store.state.biography.text;
  }
}
</script>

<style scoped>

</style>
