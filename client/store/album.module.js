import { FETCH_ALBUM } from "./actions.type";
import { SET_ALBUM } from "./mutations.type";
import { GalleryService } from "../common/api.service";
import { APP_URL } from "../common/config";

const initialState = { album: null };

export const state = { ...initialState };

export const mutations = {
  [SET_ALBUM](state, album) {
    state.album = album.map(e => {
      return {
        ...e,
        path: {
          small: APP_URL() + e.path.small,
          medium: APP_URL() + e.path.medium,
          large: APP_URL() + e.path.large
        }
      };
    });
  }
};

export const actions = {
  async [FETCH_ALBUM](context, slug) {
    const { data } = await GalleryService.show(slug);
    context.commit(SET_ALBUM, data.album);
    return data;
  }
};

export const getters = {
  album(state) {
    return state.album;
  }
};

export default {
  state,
  mutations,
  actions,
  getters
};
