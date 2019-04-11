import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  videos: [],
}

// getters
export const getters = {
  videos: state => state.videos,
}

// mutations
export const mutations = {
  [types.FETCH_VIDEOS_FAILURE] (state) {
    state.videos = []
  },

  [types.FETCH_VIDEOS_SUCCESS] (state, { videos }) {
    state.videos = videos
  },
}

// actions
export const actions = {
  async fetch ({ commit }) {
    try {
      const { data } = await axios.get('/api/videos')

      commit(types.FETCH_VIDEOS_SUCCESS, { videos: data })
    } catch (e) {
      commit(types.FETCH_VIDEOS_FAILURE)
    }
  },
}
