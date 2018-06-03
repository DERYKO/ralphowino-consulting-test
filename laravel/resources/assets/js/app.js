
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import VueResource from 'vue-resource'
import Router from 'vue-router'
Vue.use(VueResource);
Vue.use(Router)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.component('unread', require('./components/unread.vue'));
Vue.component('chats', require('./components/showfriends.vue'));
Vue.component('example', require('./components/Friend.vue'));

const app = new Vue({
    el: '#app'
});
