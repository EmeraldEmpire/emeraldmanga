<template>
	<div class="panel panel-default">

		<div class="panel-body">		
			<div class="form-group">
				<label for="name">Add New Category</label>
				<input type="text" id="name" 
					class="form-control" 
					v-model="name">
			</div>

			<button @click="addGenre" class="btn btn-success">Add</button>
		</div>
		
	</div>
</template>

<script>
	export default {
		data() {
			return {
				name: ''
			}
		},

		methods: {
			addGenre() {
				let data = { name: this.name }
				this.$emit('addGenre', data)
				this.name = ''
			}
		}
	}
</script>

<style>
	
</style>