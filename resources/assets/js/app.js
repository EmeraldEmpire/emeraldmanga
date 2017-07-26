require('./bootstrap');

window.Bus = new Vue();

import MangaList from './components/Manga/MangaList/MangaList.vue';
import MangaShow from './components/Manga/MangaShow/MangaShow.vue';
import Categories from './components/Manga/Category/Categories.vue';

const app = new Vue({
	components: {
		Categories,
		MangaList,
		MangaShow
	},
    el: '#app'
});
