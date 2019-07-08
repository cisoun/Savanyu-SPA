import axios from 'axios'
import { objectToFormData } from '~/plugins/forms'
import * as types from '../mutation-types'

// state
export const state = {
  artworks: [],
}

// getters
export const getters = {
  artworks: state => state.artworks,
  paintings: state => state.artworks.filter(a => a.category_id == 1),
  photographies: state => state.artworks.filter(a => a.category_id == 2),
  sculptures: state => state.artworks.filter(a => a.category_id == 3),
  videos: state => state.artworks.filter(a => a.category_id == 4),
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
      await axios.delete(`/api/artwork/${artwork.id}`);

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
    const params = {
      transformRequest: [function (data, headers) {
        return objectToFormData(data)
      }],
      headers: { 'Content-Type': 'multipart/form-data' }
    };

    try {
      const { data } = await axios.post('/api/artwork/store', artwork, params);

      commit(types.STORE_ARTWORK_SUCCESS, data)
    } catch (e) {
      console.error(e);
    }
  },

  async update ({ commit }, artwork) {
    // Don't send video if not necessary.
    if (artwork.category_id < 3) {
      delete artwork.video;
    }

    const params = {
      transformRequest: [function (data, headers) {
        return objectToFormData(data)
      }],
      headers: { 'Content-Type': 'multipart/form-data' }
    };

    const { data } = await axios.post(`/api/artwork/${artwork.id}`, artwork, params);

    commit(types.UPDATE_ARTWORK_SUCCESS, data);
  },
}
