<template>
	<div>
		<h2 class="sub-header">{{ manga.name }}</h2>
		<div class="panel panel-primary manga-details">
			<div class="panel-heading">
				<h3 class="panel-title">Details</h3>
			</div>

			<div class="panel-body">
				<div class="inner-details">
					<figure class="cover">
						<img :src="manga.cover_path" :alt="manga.name">
					</figure>
					<ul>
						<li>
							<p>Genre(s): </p>
							<a v-for="category in categories" href="">{{ category.name }} </a>
						</li>
						<li>
							<p>Author(s): </p>
							<a v-for="author in authors" href="">{{ author.name }} </a>
						</li>
						<li>
							<p>Artist(s): </p>
							<a v-for="artist in artists" href="">{{ artist.name }} </a>
						</li>
						<li>
							<p>Synopsis: </p> 
							<h5 class="well">{{ manga.description }}</h5>
						</li>
					</ul>
				</div>
				
			</div>
		</div>

		<div class="panel panel-default manga-chapters">
			<div class="panel-heading">
				<button type="button" data-toggle="modal" data-target="#createChapter" class="btn btn-primary">Add Chapter</button>
			</div>

			<div class="panel-body">
				<h4>Chapter List</h4>
				<table class="table table-bordered">
					<tbody>
						<chapter-list v-for="(chapter, i) in chapters"
							:i="i"
							:chapter="chapter"
							:manga="manga"
							@deleteChapter="deleteChapter"></chapter-list>
					</tbody>
				</table>
			</div>
		</div>
		<create-chapter-modal :manga="manga"
			@createChapter="createChapter"></create-chapter-modal> <!-- Modal -->
	</div>
</template>

<script>
	import CreateChapterModal from './CreateChapterModal.vue'
	import ChapterList from './ChapterList.vue'

	export default {
		components: {
			CreateChapterModal,
			ChapterList
		},

		props: ['manga'],

		data() {
			return {
				categories: this.manga.categories,
				chapters: this.manga.chapters,
				authors: this.manga.authors,
				artists: this.manga.artists
			}
		},

		methods: {
			createChapter(data) {
				this.chapters.push(data)
			},

			deleteChapter(data, i) {
				// swal({
				// 	title: 
				// })
				// axios.post('/admin/manga/' + this.manga.slug + '/' + this.chapter.num + '/delete')
				// 	.then(response => {

				// 	})
				// 	.catch(error => console.log(error.response.data))
			}
		},
	}
</script>

<style lang="scss">
	
	.chapter-list {
		margin: 0;
		padding: 0;
		list-style: none;
	}

	.inner-details {

		ul {
			list-style: none;
			margin: 20px 0 0 20px;
			padding: 0;
			float: left;
			li {
				a {
					text-decoration: none;
				}

				h5 {
					margin: 0;
				}
			}
			
		}

		p {
			display: inline-block;
			font-weight: 700;
		}
	}

	.cover {
		display: inline-block;
		height: 354px;
		width: 254px;
		border: 2px solid #e5e5e5;
		float: left;

		img {
			max-height: 350px;
			max-width: 250px;
		}
	}
</style>