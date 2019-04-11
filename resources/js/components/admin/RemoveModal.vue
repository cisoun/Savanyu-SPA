<template>
  <b-modal ref="modal"
           :title="title"
           :cancel-title="$t('cancel')"
           :ok-title="$t('delete')"
           @ok="confirm">
    <span v-html="$t('delete_confirm', [ itemName ])"></span>
  </b-modal>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  name: 'RemoveModal',

  props: {
    title: { type: String, required: false }
  },

  data: () => ({
    item: null,
    itemName: ''
  }),

  methods: {
    confirm () {
      this.$emit('confirm', this.item);
      //this.$refs.modal.hide();
    },

    show (itemName, item) {
      this.item = item;
      this.itemName = itemName;
      this.$refs.modal.show();
    }
  }
}
</script>
