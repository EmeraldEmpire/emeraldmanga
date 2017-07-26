require('./bootstrap');

window.Bus = new Vue();

import MangaList from './components/Manga/MangaList/MangaList.vue';
import MangaShow from './components/Manga/MangaShow/MangaShow.vue';
import Genres from './components/Manga/Genre/Genres.vue';

const app = new Vue({
	components: {
		Genres,
		MangaList,
		MangaShow
	},
    el: '#app'
});
