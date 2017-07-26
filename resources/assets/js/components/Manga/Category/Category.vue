<template>
	<tr>
		<td class="my-default">
			<p v-show="!isUpdating">{{ category.name }}</p>
			<input type="text" class="form-control"
				v-show="isUpdating"
				v-model="name">
		</td>
		<td class="actions">

			<button class="btn btn-danger"
				@click="deleteCategory">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				Delete
			</button>
			
			<button class="btn"
				:class="toggleBtn"
				:title="title"
				@click="toggleEdit" >
				<span class="glyphicon"
					:class="toggleIcon" aria-hidden="true"></span>
				Edit
			</button>

			<button class="btn btn-success"
					:class="{ 'hidden': !isUpdating }"
					@click="updateCategory"
					:disabled="isChanged">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				Save
			</button>

		</td>
	</tr>
</template>

<script>
	export default {
		props: ['category', 'index'],

		data() {
			return {
				isUpdating: false,
				name: this.category.name
			}
		},

		methods: {
			deleteCategory() {
				this.$emit('deleteCategory', this.category, this.index)
				if (this.isUpdating) {
					this.isUpdating = !this.isUpdating
				}
			},

			toggleEdit() {
				this.isUpdating = !this.isUpdating
				this.name = this.category.name
			},

			updateCategory() {
				let data = { name: this.name }
				this.$emit('updateCategory', 
					data, 
					this.category.id, 
					this.index)

				this.isUpdating = !this.isUpdating
			}
		},

		computed: {
			toggleIcon() {
				return ( this.isUpdating ? 'glyphicon-remove': 'glyphicon-edit' )
			},

			toggleBtn() {
				return ( this.isUpdating ? 'btn-warning': 'btn-default' )
			},

			title() {
				return ( this.isUpdating ? 'Cancel' : 'Edit' )
			},

			isChanged() {
				return (this.name.toLowerCase() == this.category.name.toLowerCase())
			}
		}
	}
</script>

<style lang="scss">
	.actions .hidden {
		visibility: hidden;
	}
</style>