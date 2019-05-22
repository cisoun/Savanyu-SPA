<template>
<iframe class="video" :src="src" frameborder="0" allowfullscreen></iframe>
</template>

<script>
export default {
  name: 'Youtube',

  props: {
    url: { type: String, default: '' },
  },

  computed: {
    src () {
      return 'https://www.youtube.com/embed/' + this.url;
    }
  }
}
</script>
