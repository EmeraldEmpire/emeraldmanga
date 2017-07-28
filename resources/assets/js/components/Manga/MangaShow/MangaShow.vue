<template>
	<div>
		<h2 class="sub-header">{{ manga.name }}</h2>
		<div class="panel panel-primary manga-details">
			<div class="panel-heading">
				<h3 class="panel-title">Details</h3>
			</div>

			<div class="panel-body">
				<manga-details :manga="manga"
					@updateManga="updateManga"
					:genres="genres"
					:authors="authors"
					:artists="artists"></manga-details>
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
						<chapter-list v-for="(chapter, i) in manga.chapters"
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
	import MangaDetails from './MangaDetails'

	export default {
		components: {
			CreateChapterModal,
			ChapterList,
			MangaDetails
		},

		props: ['storeManga', 'genres', 'authors', 'artists'],

		data() {
			return {
				manga: this.storeManga,
				isUpdating: false
			}
		},

		methods: {
			createChapter(data) {
				this.manga.chapters.unshift(data)
			},

			deleteChapter(data, i) {
				swal({
					title: "Delete Chapter",
					text: "You are about to delete a chapter!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Confirm",
					closeOnConfirm: false,
					html: false
				}, function () {
					axios.delete('/admin/manga/' + data.manga_id + '/chapters/' + data.id)
						.then(response => {
							this.manga.chapters.splice(i, 1)
							swal("Deleted!",
								"A Chapter has been deleted.",
								"success")
						})
						.catch(error => console.log(error.response.data))
					}.bind(this))
				
			},

			updateManga(data) {
				axios.post(`/admin/manga/${this.manga.id}`, data)
					.then(response => {
						this.manga = response.data
						Bus.$emit('updated')
						swal("Updated!", "Manga has been updated.", "success")
					})
					.catch(error => console.log(error.response))
			}
		},
	}
</script>

<style lang="scss">
	
</style>