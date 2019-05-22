<template>
<iframe class="video" :src="url" frameborder="0" allowfullscreen></iframe>
</template>

<script>
export default {
  name: 'Youtube',

  props: {
    id: { type: String, default: '' },
  },

  computed: {
    url () {
      return 'https://www.youtube.com/embed/' + this.id;
    }
  }
}
</script>
