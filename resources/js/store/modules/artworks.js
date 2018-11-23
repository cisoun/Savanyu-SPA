import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  artworks: [],
}

// getters
export const getters = {
  artworks: state => state.artworks,
}

// mutations
export const mutations = {
  [types.DESTROY_ARTWORKS_SUCCESS] (state, artwork) {
    const index = state.artworks.findIndex(a => a.id == artwork.id)
    state.artworks.removeAt(index);
  },

  [types.FETCH_ARTWORKS_FAILURE] (state) {
    state.artworks = []
  },

  [types.FETCH_ARTWORKS_SUCCESS] (state, { artworks }) {
    state.artworks = artworks
  },

  [types.STORE_ARTWORK_SUCCESS] (state, artwork) {
    state.artworks.push(artwork);
  },

  [types.UPDATE_ARTWORK_SUCCESS] (state, artwork) {
    const index = state.artworks.findIndex(f => f.id == artwork.id);
    state.artworks.replaceAt(index, artwork);
  }
}

// actions
export const actions = {
  async destroy ({ commit }, artwork) {
    try {
      const { data } = await axios.delete(`/api/artwork/${artwork.id}`)

      commit(types.DESTROY_ARTWORKS_SUCCESS, artwork)
    } catch (e) { }
  },

  async fetch ({ commit }) {
    try {
      const { data } = await axios.get('/api/artworks')

      commit(types.FETCH_ARTWORKS_SUCCESS, { artworks: data })
    } catch (e) {
      commit(types.FETCH_ARTWORKS_FAILURE)
    }
  },

  async store ({ commit }, artwork) {
    commit(types.STORE_ARTWORK_SUCCESS, artwork)
  },

  async update ({ commit }, artwork) {
    commit(types.UPDATE_ARTWORK_SUCCESS, artwork)
  },
}
