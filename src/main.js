import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from './router'
import VueToastr from "vue-toastr";

Vue.config.productionTip = false
Vue.use(VueToastr, {
  /* OverWrite Plugin Options if you need */
});

new Vue({
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app')
