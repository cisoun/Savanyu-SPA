<template>
  <div>
    <div class="main-layout container" :class="{ 'blurred' : blurred }">
      <div class="row">
        <div class="col-3">
          <Sidebar />
        </div>
        <div class="col-9 content">
          <div ref="scrollable" class="scrollable">
            <child @popup="showArtwork"/>
          </div>
        </div>
        <div class="d-none d-sm-block arrows">
          <a href="#" class="arrow" @click="scrollTop()"></a>
          <a href="#" class="arrow arrow-down" @click="scrollBottom()"></a>
        </div>
      </div>
    </div>
    <Popup ref="popup" @showing="blurred = true" @closing="blurred = false" />
  </div>
</template>

<script>
export default {
  name: 'MainLayout',

  data: () => ({
    blurred: false
  }),

  methods: {
    scrollBottom () {
      this.$refs.scrollable.scrollTop += 700;
    },

    scrollTop () {
      this.$refs.scrollable.scrollTop -= 700;
    },

    showArtwork (artwork) {
      this.$refs.popup.show(artwork)
    },
  }
}
</script>

<style scoped>
.content {
    height: 700px;
    overflow: hidden;
}

.scrollable {
  width: 770px;
  height: 700px;
  overflow-y: scroll;
  padding-right: 32px;
  scroll-behavior: smooth;
}

.arrows {
  height: 50px;
  left: 1060px;
  position: relative;
  top: -380px;
  width: 55px;
}

.arrow {
  background-image: url(~/img/arrow.png);
  background-size: contain;
  display: block;
  height: 11px;
  margin: 12px 0;
  width: 28px;
}

.arrow-down {
  transform: rotate(180deg);
}
</style>
