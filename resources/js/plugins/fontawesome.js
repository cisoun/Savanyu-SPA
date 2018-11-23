import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faCog,
  faEdit,
  faLock,
  faPlus,
  faSignOutAlt,
  faTrash,
  faUser,
} from '@fortawesome/free-solid-svg-icons'

import {

} from '@fortawesome/free-brands-svg-icons'

library.add(
  faCog,
  faEdit,
  faLock,
  faPlus,
  faSignOutAlt,
  faTrash,
  faUser,
)

Vue.component('fa', FontAwesomeIcon)
