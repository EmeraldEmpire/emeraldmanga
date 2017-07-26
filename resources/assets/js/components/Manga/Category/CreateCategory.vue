<template>
	<div class="panel panel-default">

		<div class="panel-body">		
			<div class="form-group">
				<label for="name">Add New Category</label>
				<input type="text" id="name" 
					class="form-control" 
					v-model="name">
			</div>

			<button @click="add" class="btn btn-success">Add</button>
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
			add() {
				let data = { name: this.name }
				this.$emit('addCategory', data)
				this.name = ''
			}
		}
	}
</script>

<style>
	
</style>