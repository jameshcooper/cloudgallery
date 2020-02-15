import { FETCH_GALLERY } from "./actions.type";
import { SET_GALLERY } from "./mutations.type";
import { GalleryService } from "../common/api.service";

const initialState = { gallery: null };

export const state = { ...initialState };

export const mutations = {
  [SET_GALLERY](state, gallery) {
    state.gallery = gallery;
  }
};

export const actions = {
  async [FETCH_GALLERY](context) {
    const { data } = await GalleryService.index();
    context.commit(SET_GALLERY, data.gallery);
    return data;
  }
};

export const getters = {
  gallery(state) {
    return state.gallery;
  }
};

export default {
  state,
  mutations,
  actions,
  getters
};
