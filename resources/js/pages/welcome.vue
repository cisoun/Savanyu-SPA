<template>
  <div id="container">
            <div id="menu">
                <a id="menu-works" href="">Travaux</a>
                <ul id="menu-works-list">
                    <li><a href="">Peinture</a></li>
                    <li><a href="">Photographie</a></li>
                    <li><a href="">Sculpture</a></li>
                    <li><a href="">Vidéo</a></li>
                </ul>
                <a id="menu-bio" href="">Bio</a>
                <p class="space"></p>
                <a id="menu-instagram" href="#" class="icon icon-instagram">Instagram</a>
                <a id="menu-contact" href="#" class="icon icon-contact">Contact</a>
                <a id="menu-title" href="">Victor Savanyu</a>
            </div>
            <div id="content">

            </div>
        </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName
  }),
}
</script>
