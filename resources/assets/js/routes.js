import VueRouter from 'vue-router';
import Vue from 'vue';

import MangaList from './components/Manga/MangaList/MangaList.vue';
import Example from './components/Example.vue';

Vue.use(VueRouter);

let routes = [
	{
		path: '/example',
		component: Example
	}
];

let router = new VueRouter({ routes, mode: 'history' });

export default router