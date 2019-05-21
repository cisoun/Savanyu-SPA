<template>
  <table>
    <tr v-for="row in toJson(text)">
      <td v-for="column in row" :colspan="3 - row.length" :class="{'section': isSection(row)}">{{ column }}</td>
    </tr>
  </table>
</template>

<script>
export default {
  name: 'BiographyTable',

  props: {
    text: { type: String, default: '' }
  },

  methods: {
    isSection (row) {
      return row.length < 2;
    },

    toJson (text) {
      let content = [];

      const lines = text.split('\n');
      lines.forEach((line) => {
        // If empty line, pass...
        if (line.trim() == '') {
          return; // Equals to 'continue' in for loops.
        }

        const parts = line.split('\t');
        content.push(parts);
      });

      return content;
    }
  }
}
</script>

<style scoped>
table { border-collapse: collapse; }
table td { padding: 0; }
table tr td:first-child { padding-right: 2rem; }
.section {
  font-weight: 400;
  padding: 2rem 0;
}
</style>
