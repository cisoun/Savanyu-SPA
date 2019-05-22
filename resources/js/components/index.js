import Vue from 'vue'

import ArtworkModal from './admin/ArtworkModal'
import BiographyTable from './BiographyTable'
import RemoveModal from './admin/RemoveModal'
import Youtube from './Youtube'

import Button from './Button'
import Card from './Card'
import Checkbox from './Checkbox'
import Child from './Child'
import Popup from './Popup'
import Sidebar from './Sidebar'
import { HasError, AlertError, AlertSuccess } from 'vform'

// Components that are registered globaly.
[
  AlertError,
  AlertSuccess,
  ArtworkModal,
  BiographyTable,
  Button,
  Card,
  Checkbox,
  Child,
  HasError,
  Popup,
  RemoveModal,
  Sidebar,
  Youtube
].forEach(Component => {
  Vue.component(Component.name, Component)
})
