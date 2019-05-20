import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faArrowLeft,
  faArrowRight,
  //faBars,
  faCode,
  faCog,
  faEdit,
  faEye,
  faGlobe,
  faHome,
  faLanguage,
  faLock,
  faQuestionCircle,
  faPalette,
  faPen,
  faPlus,
  faSignOutAlt,
  faTimes,
  faTrash,
  faUser,
} from '@fortawesome/free-solid-svg-icons'

import {

} from '@fortawesome/free-brands-svg-icons'

library.add(
  faArrowLeft,
  faArrowRight,
  //faBars,
  faCode,
  faCog,
  faEdit,
  faEye,
  faGlobe,
  faHome,
  faLanguage,
  faLock,
  faPalette,
  faPen,
  faPlus,
  faQuestionCircle,
  faSignOutAlt,
  faTimes,
  faTrash,
  faUser,
)

Vue.component('fa', FontAwesomeIcon)
