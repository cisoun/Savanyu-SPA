import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import BootstrapVue from 'bootstrap-vue'
//import Sortable from 'vue-sortable'
import App from '~/components/App'

import '~/plugins'
import '~/components'


Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})

Vue.use(BootstrapVue);
//Vue.use(Sortable)
