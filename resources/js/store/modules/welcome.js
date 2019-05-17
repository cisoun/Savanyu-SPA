import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  image: null,
  text: ''
}

// getters
export const getters = {
  image: state => state.image,
  text: state => state.text
}

// mutations
export const mutations = {
  [types.FETCH_WELCOME_SUCCESS] (state, { data }) {
    state.image = data.image,
    state.text = data.text
  },
}

// actions
export const actions = {
  async fetch ({ commit }) {
    try {
      const { data } = await axios.get('/api/welcome')

      commit(types.FETCH_WELCOME_SUCCESS, { data: data })
    } catch (e) {
      // ...
    }
  },

  async update ({ commit }, data) {
    const formData = new FormData();
    formData.append('image', data.file);
    formData.append('text', data.text);

    return await axios.post('/api/welcome', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    }).then((data) => {
      commit(types.FETCH_WELCOME_SUCCESS, { data: data })
    });
  }
}
