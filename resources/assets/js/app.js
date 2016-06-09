import Vue from 'vue';
import VueResource from 'vue-resource';

import $ from 'jquery';

window.$ = window.jQuery = $;

require('bootstrap-sass');

Vue.config.debug = true;

Vue.use(VueResource);

new Vue({
   el: 'body'
});
