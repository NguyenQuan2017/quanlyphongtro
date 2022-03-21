require('./bootstrap');

import { createApp } from "vue";
import router from './routes';
import App from './App';
import VueCookie from "vue-cookie";
import store from "./store/store";
import moment from "moment";

require('bootstrap/dist/css/bootstrap.min.css');

const app = createApp(App);
app.use(router);
app.config.globalProperties.$moment = moment;
app.use(VueCookie);
app.use(store);
app.mount('#app');
