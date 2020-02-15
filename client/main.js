import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import APIService from "./common/api.service";
import "./common/plugin.fontawesome";
import DateFilter from "./common/date.filter";
import ErrorFilter from "./common/error.filter";

Vue.config.productionTip = false;
Vue.config.devtools = true;
Vue.filter("date", DateFilter);
Vue.filter("error", ErrorFilter);

APIService.init();

Vue.use(BootstrapVue);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
