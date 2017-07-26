<template>
	<div class="modal fade" id="createManga">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				
				<div class="modal-body">
					
					<form ref="createMangaRef" id="form-data" enctype="multipart/form-data">
						<div class="form-group">
							<label for="name">Name / Title</label>
							<input type="text" name="name" id="name" class="form-control">
						</div>

						<div class="form-group">
							<label for="description">Description / Synopsis</label>
							<textarea id="description" name="description" class="form-control" style="resize:none;"></textarea>
						</div>

						<div class="form-group">
							<label for="genres">Genre(s)</label>
							<select name="genres[]" id="genres" 
								multiple="multiple" 
								class="form-control multi-select-search" 
								style="width:100%"></select>
						</div>

						<div class="form-group">
							<label for="authors">Author(s)</label>
							<select name="authors[]" id="authors" 
								multiple="multiple" 
								class="form-control select2-multi" 
								style="width:100%;">

								<option v-for="author in authors" 
									:value="author.id">{{ author.name }}</option>
							</select>
						</div>

						<div class="form-group">
							<label for="artists">Artist(s)</label>
							<select name="artists[]" id="artists" 
								multiple="multiple" 
								class="form-control select2-multi" 
								style="width:100%;">

								<option v-for="artist in artists" 
									:value="artist.id">{{ artist.name }}</option>
							</select>
						</div>

						<div class="form-group col-sm-6">
							<label for="">Year Released</label>
							<input type="number" name="year_released" class="form-control">
						</div>

						<div class="form-group col-sm-6">
							<label for="status">Status</label>
							<select name="is_completed" id="status" class="form-control">
								<option value="0">On Going</option>
								<option value="1">Completed</option>
							</select>
						</div>

						<div class="form-group">
							<label for="cover">Cover Image</label>
							<input type="file" name="cover" id="cover">
						</div>
						
						<button type="button" class="btn btn-success" @click="createManga">Submit</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

					</form>
				</div> <!-- modal body -->
			</div> <!-- modal content -->
		</div> <!-- modal dialog -->
	</div> <!-- modal fade -->
</template>

<script>
	export default {
		props: ['authors', 'artists'],

		data() {
			return {
				
			}
		},

		methods: {
			createManga() {
				let createMangaRef = this.$refs.createMangaRef
				let formData = new FormData(createMangaRef)
				
				axios.post('/admin/manga', formData)
					.then(response => {
						this.$emit('createManga', response.data)
						createMangaRef.reset()
						$('.multi-select-search, .select2-multi').val([]).trigger('change')
						swal("Added!", "A new Manga has been added.", "success")
					})
					.catch(error => console.log(error.response.data))
					
			}
		}
	}
</script>

<style lang="scss">
</style>