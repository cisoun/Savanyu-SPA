<template>
  <Editable ref="editable" :value="internalValue" @focus="focus" :placeholder="placeholder">
    <textarea ref="textarea" v-model="internalValue" @change="changed" @blur="blur" class="w-100" />
  </Editable>
</template>

<script>
export default {
  name: 'EditableTextArea',

  props: {
    placeholder: { type: String, default: '...' },
    value: { type: String, default: false },
  },

  data: () => ({
    internalValue: '',
  }),

  mounted () {
    this.internalValue = this.value;
  },

  methods: {
    blur () {
      this.$refs.editable.blur();
    },

    changed () {
      this.$refs.editable.changed();
    },

    focus () {
      this.$refs.textarea.focus();
    }
  },

  watch: {
    value (val) {
      this.internalValue = val;
    }
  },
}
</script>
