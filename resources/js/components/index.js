import Vue from 'vue'

import ArtworkModal from './admin/ArtworkModal'
import RemoveModal from './admin/RemoveModal'
import Editable from './admin/Editable'
import EditableText from './admin/EditableText'
import EditableTextArea from './admin/EditableTextArea'

import BiographyTable from './BiographyTable'

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
  Editable,
  EditableText,
  EditableTextArea,
  HasError,
  Popup,
  RemoveModal,
  Sidebar
].forEach(Component => {
  Vue.component(Component.name, Component)
})
