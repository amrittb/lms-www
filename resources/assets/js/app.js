import Vue from 'vue';
import VueResource from 'vue-resource';

import $ from 'jquery';

window.$ = window.jQuery = $;

require('bootstrap-sass');

require('./vendor/chosen');

import DateTimePicker from "./components/FormDateTimePicker.vue";

Vue.config.debug = true;

Vue.use(VueResource);

Vue.component('date-picker',DateTimePicker);

new Vue({
   el: 'body'
});
