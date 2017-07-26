<template>
	<div>
		<h1 class="page-header">Manga</h1>
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<button class="btn btn-primary" data-toggle="modal" data-target="#createManga">Add New Manga</button>
			</div>

			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Title</th>
							<th>Description</th>
							<th>Status</th>
							<th>Year Released</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						<manga-row v-for="(manga, i) in mangas"
							:manga="manga"
							:i="i"
							@deleteManga="deleteManga"></manga-row>
					</tbody>
				</table>
			</div> <!--  manga content  -->

		</div> <!-- content wrapper -->

		<create-manga-modal :authors="authors" 
			:artists="artists"
			@createManga="createManga"></create-manga-modal>

	</div>
</template>

<script>
	import MangaRow from './MangaRow.vue'
	import CreateMangaModal from './CreateMangaModal.vue'

	export default {
		components: {
			MangaRow,
			CreateMangaModal
		},

		props: ['storeMangas', 'authors', 'artists'],

		data() {
			return {
				mangas: this.storeMangas
			}
		},

		methods: {
			createManga(data) {
				this.mangas.push(data)
			},

			deleteManga(data, i) {
				swal({
					title: "Delete Manga",
					text: `You are about to delete "${data.name}" manga. You will not be able to retrieve the contents after deleting it.`,
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#DD6B55',
					confirmButtonText: 'Delete',
					closeOnConfirm: false,
					html: false

				}, function () {
					axios.post(`/admin/manga/${data.slug}/delete`)
						.then(response => {
							this.mangas.splice(i, 1)

							swal('Deleted',
								'"' + data.name + '" Manga has been deleted.',
								'success')
						})
						.catch(error => console.log(error.response.data))
				}.bind(this))
				
			}
		},

		mounted() {

		},
	}
</script>

<style lang="scss">
	
	.manga-content {
		background-color: #fff;
		height: 1000px;
		overflow: auto;
	}
	
</style>