<template>
	<div class="clearfix">
		<h1 class="page-header">Categories</h1>
		<div class="col-lg-6 col-lg-offset-3">
			
			<create-category @addCategory="addCategory"></create-category>

			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-bordered">

						<thead>
							<tr>
								<th>Categories</th>
								<th style="width:45%;">Actions</th>
							</tr>			
						</thead>

						<tbody>
							<category v-for="(category, index) in categories" 
								:category="category"
								:index="index"
								@deleteCategory="deleteCategory"
								@updateCategory="updateCategory"></category>
						</tbody>

					</table>
				</div>
			</div>

			
			
		</div>
	</div>
</template>

<script>
	import Category from './Category'
	import CreateCategory from './CreateCategory'

	export default {
		components: {
			Category,
			CreateCategory
		},
		props: ['cats'],

		data() {
			return {
				categories: this.cats
			}
		},

		methods: {
			addCategory(data) {
				axios.post('/admin/categories', data)
					.then(response => {	
						this.cats.push(response.data);
						swal("Added!", "New category has been added.", "success")
					})
					.catch(error => console.log(error.response.data))
			},

			updateCategory(data, id, index) {
				axios.put('/admin/categories/' + id, data)
					.then(response => {
						this.categories.splice(index, 1, response.data)
						swal("Updated", "Category has been successfully updated.", "success")
					})
					.catch(error => console.log(error.response.data))
			},

			deleteCategory(data, index) {
				swal({
					title: 'Are you sure?',
					text: 'You are about to delete ' + data.name + ' Category',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#DD6B55',
					confirmButtonText: 'Delete',
					closeOnConfirm: false,
					html: false

				}, function () {
					axios.delete('/admin/categories/' + data.id)
						.then(response => {
							this.categories.splice(index, 1)

							swal('Deleted',
							data.name + ' Category has been deleted.',
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