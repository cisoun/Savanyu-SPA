import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  uploads: [],
}

// getters
export const getters = {
  uploads: state => state.uploads,
}

// mutations
export const mutations = {
  [types.DESTROY_UPLOAD_SUCCESS] (state, upload) {
    state.uploads.remove(upload);
  },

  [types.FETCH_UPLOADS_FAILURE] (state) {
    state.uploads = []
  },

  [types.FETCH_UPLOADS_SUCCESS] (state, { uploads }) {
    state.uploads = uploads
  },
}

// actions
export const actions = {
  async destroy ({ commit }, upload) {
    try {
      await axios.delete(`/api/upload/${upload.id}`);

      commit(types.DESTROY_UPLOAD_SUCCESS, upload)
    } catch (e) { }
  },

  async fetch ({ commit }) {
    try {
      const { data } = await axios.get('/api/uploads')

      commit(types.FETCH_UPLOADS_SUCCESS, { uploads: data })
    } catch (e) {
      commit(types.FETCH_UPLOADS_FAILURE)
    }
  },
}
