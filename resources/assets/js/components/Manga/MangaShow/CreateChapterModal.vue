<template>
	<div id="createChapter" class="modal fade">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Chapter</h4>
				</div>
				<div class="modal-body">
					<form id="create-chapter" enctype="multipart/form-data" ref="createChapterRef">

						<div class="form-group">
							<label for="title">Chapter Name / Title</label>
							<input type="text" name="chapter_title" id="title" class="form-control" placeholder="Optional">
						</div>

						<div class="form-group">
							<label for="number">Chapter Number</label>
							<input type="number" name="chapter_num" id="number" class="form-control" placeholder="ex: 1">
						</div>

						<div class="form-group">
							<label for="image">Chapter Pages</label>
							<input multiple type="file" name="img[]" id="image" class="form-control">
						</div>
						
						<button type="button" class="btn btn-primary" @click="createChapter('dismiss')">Submit and Dismiss</button>
						<button type="button" class="btn btn-success" @click="createChapter">Submit</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
					</form>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['manga'],

		data() {
			return {
				isLoading: false
			}
		},

		methods: {
			createChapter(submitType = null) {
				let createChapterRef = this.$refs.createChapterRef
				let formData = new FormData(createChapterRef)
				axios.post('/admin/manga/' + this.manga.id + '/chapters', formData)
					.then(response => {
						this.$emit('createChapter', response.data)
						createChapterRef.reset()
						if (submitType == 'dismiss') {
							$('#createChapter').modal('hide')
						}
						swal("Added!", "A new Manga has been added.", "success")
						console.log(response.data)
					})
					.catch(error => console.log(error.response.data))
			}
		}
	}
</script>

<style>
	
</style>