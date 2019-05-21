import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  text: ''
}

// getters
export const getters = {
  text: state => state.text
}

// mutations
export const mutations = {
  [types.FETCH_BIOGRAPHY_SUCCESS] (state, data) {
    state.text = data.text
  },
}

// actions
export const actions = {
  async fetch ({ commit }) {
    try {
      const { data } = await axios.get('/api/biography')

      commit(types.FETCH_BIOGRAPHY_SUCCESS, data)
    } catch (e) {
      // ...
    }
  },

  async update ({ commit }, text) {
    try {
      const { data } = await axios.post('/api/biography', text)

      commit(types.FETCH_BIOGRAPHY_SUCCESS, data)
    } catch (e) {
      // ...
    }
  }
}
