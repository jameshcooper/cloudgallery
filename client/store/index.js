import Vue from "vue";
import Vuex from "vuex";

import album from "./album.module";
import gallery from "./gallery.module";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    album,
    gallery
  }
});
