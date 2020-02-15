import Vue from "vue";
import Router from "vue-router";
import { FETCH_ALBUM } from "../store/actions.type";
import store from "@/store";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "",
      component: () => import("../views/Gallery"),
      children: [
        {
          path: ":album",
          component: () => import("../views/Album"),
          beforeEnter: (to, from, next) => {
            Promise.all([store.dispatch(FETCH_ALBUM, to.params.album)]).then(
              () => {
                next();
              }
            );
          }
        }
      ]
    }
  ]
});
