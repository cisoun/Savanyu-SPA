import './axios'
import { fastmd } from './fastmd'
import './fontawesome'
import './helpers'
import 'bootstrap'

export let mixins = {
  methods: {
    fastmd (text) {
      return fastmd(text);
    },
  }
}
