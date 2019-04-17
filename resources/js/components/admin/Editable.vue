<template>
  <div class="editable" v-bind:class="{ 'editable-focus': editing }" @click="edit()">
    <span v-if="!editing" class="text" :class="{ 'text-muted': internalValue.isNullOrWhiteSpace() }" v-html="text" />
    <slot v-else />
  </div>
</template>

<script>
export default {
  name: 'Editable',

  props: {
    placeholder: { type: [String, Number], default: '...' },
    value: { type: String, default: '' },
  },

  data: () => ({
    editing: false,
    internalValue: '',
  }),

  computed: {
    text () {
      if (this.internalValue.isNullOrWhiteSpace()) {
        return this.placeholder;
      }

      return this.internalValue.replace(/\n/g, '<br/>');
    }
  },

  mounted () {
    this.internalValue = this.value;
  },

  methods: {
    blur () {
      this.editing = false;
    },

    changed () {
      this.blur();
      this.$parent.$emit('changed', this.internalValue);
    },

    edit () {
      this.editing = true;

      this.$nextTick(function () {
        this.$emit('focus');
      });
    }
  },

  watch: {
    value (val) {
      this.internalValue = val;
    },

    internalValue (val, oldVal) {
      if (val !== oldVal) {
        this.$emit('input', val)
      }
    }
  },
}
</script>
