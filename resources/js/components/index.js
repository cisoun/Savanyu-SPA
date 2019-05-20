import Vue from 'vue'

import ArtworkModal from './admin/ArtworkModal'
import RemoveModal from './admin/RemoveModal'
import Editable from './admin/Editable'
import EditableText from './admin/EditableText'
import EditableTextArea from './admin/EditableTextArea'

import Button from './Button'
import Card from './Card'
import Checkbox from './Checkbox'
import Child from './Child'
import Popup from './Popup'
import Sidebar from './Sidebar'
import { HasError, AlertError, AlertSuccess } from 'vform'

// Components that are registered globaly.
[
  ArtworkModal,
  RemoveModal,
  Editable,
  EditableText,
  EditableTextArea,
  AlertError,
  AlertSuccess,
  Button,
  Card,
  Checkbox,
  Child,
  HasError,
  Popup,
  Sidebar
].forEach(Component => {
  Vue.component(Component.name, Component)
})
