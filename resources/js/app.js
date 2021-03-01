require('./bootstrap');
require('alpinejs');

import Vue    from 'vue';
import Layout from './components/Layout';
import store  from './store/store';


Vue.component('layout', Layout);

new Vue({
	store
}).$mount('#app');
