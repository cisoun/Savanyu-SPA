<template>
  <Editable ref="editable" :value="internalValue" @focus="focus" :placeholder="placeholder">
    <input ref="input" v-model="internalValue" @change="changed" @blur="blur" class="w-100" />
  </Editable>
</template>

<script>
export default {
  name: 'EditableText',

  props: {
    placeholder: { type: [String, Number], default: '...' },
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
      this.$refs.input.focus();
    }
  },

  watch: {
    value (val) {
      this.internalValue = val;
    }
  },
}
</script>
