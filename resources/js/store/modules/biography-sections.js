import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  biography_sections: [],
}

// getters
export const getters = {
  biography_sections: state => state.biography_sections,
}

// mutations
export const mutations = {
  [types.DESTROY_BIOGRAPHY_SECTIONS_SUCCESS] (state, section) {
    const index = state.biography_sections.findIndex(a => a.id == section.id)
    state.biography_sections.removeAt(index);
  },

  [types.FETCH_BIOGRAPHY_SECTIONS_FAILURE] (state) {
    state.biography_sections = []
  },

  [types.FETCH_BIOGRAPHY_SECTIONS_SUCCESS] (state, { sections }) {
    state.biography_sections = sections
  },

  [types.STORE_BIOGRAPHY_SECTION_SUCCESS] (state, section) {
    state.biography_sections.push(section);
  },

  [types.UPDATE_BIOGRAPHY_SECTION_SUCCESS] (state, section) {
    const index = state.biography_sections.findIndex(f => f.id == section.id);
    state.biography_sections.replaceAt(index, section);
  }
}

// actions
export const actions = {
  async destroy ({ commit }, section) {
    try {
      const { data } = await axios.delete(`/api/biography/section/${section.id}`)

      commit(types.DESTROY_BIOGRAPHY_SECTIONS_SUCCESS, section)
    } catch (e) { }
  },

  async fetch ({ commit }) {
    try {
      const { data } = await axios.get('/api/biography/sections')

      commit(types.FETCH_BIOGRAPHY_SECTIONS_SUCCESS, { sections: data })
    } catch (e) {
      commit(types.FETCH_BIOGRAPHY_SECTIONS_FAILURE)
    }
  },

  async store ({ commit }, biography_section) {
    commit(types.STORE_BIOGRAPHY_SECTION_SUCCESS, section)
  },

  async update ({ commit }, biography_section) {
    commit(types.UPDATE_BIOGRAPHY_SECTION_SUCCESS, section)
  },
}
