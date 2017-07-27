<template>
	<div class="clearfix">
		<h1 class="page-header">Genres</h1>
		<div class="col-lg-6 col-lg-offset-3">
			
			<create-genre @addGenre="addGenre"></create-genre>

			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-bordered">

						<thead>
							<tr>
								<th>Genres</th>
								<th style="width:45%;">Actions</th>
							</tr>			
						</thead>

						<tbody>
							<genre v-for="(genre, index) in genres" 
								:genre="genre"
								:index="index"
								@deleteGenre="deleteGenre"
								@updateGenre="updateGenre"></genre>
						</tbody>

					</table>
				</div>
			</div>

			
			
		</div>
	</div>
</template>

<script>
	import Genre from './Genre'
	import CreateGenre from './CreateGenre'

	export default {
		components: {
			Genre,
			CreateGenre
		},
		props: ['storeGenres'],

		data() {
			return {
				genres: this.storeGenres
			}
		},

		methods: {
			addGenre(data) {
				axios.post('/admin/genres', data)
					.then(response => {	
						this.genres.push(response.data);
						swal("Added!", "New genre has been added.", "success")
					})
					.catch(error => console.log(error.response.data))
			},

			updateGenre(data, id, index) {
				axios.put('/admin/genres/' + id, data)
					.then(response => {
						this.genres.splice(index, 1, response.data)
						swal("Updated", "Genre has been successfully updated.", "success")
					})
					.catch(error => console.log(error.response.data))
			},

			deleteGenre(data, index) {
				swal({
					title: 'Are you sure?',
					text: 'You are about to delete ' + data.name + ' Genre',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#DD6B55',
					confirmButtonText: 'Delete',
					closeOnConfirm: false,
					html: false

				}, function () {
					axios.delete('/admin/genres/' + data.id)
						.then(response => {
							this.genres.splice(index, 1)

							swal('Deleted',
							data.name + ' Genre has been deleted.',
							'success')
						})
						.catch(error => console.log(error.response.data))	
				}.bind(this))
			
			}
		}
	}
</script>

<style>
	
</style>