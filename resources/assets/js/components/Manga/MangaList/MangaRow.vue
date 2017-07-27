<template>
	<tr>
		<td><a :href="showMangaLink">{{ manga.name }}</a></td>
		<td>{{ manga.description }}</td>
		<td>{{ manga.is_completed }}</td>
		<td>{{ manga.year_released }}</td>
		<td class="actions">
			<button class="btn btn-danger" @click="$emit('deleteManga', manga, i)">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				Delete
			</button>
			<a class="btn btn-default"
				:href="showMangaLink"
				@click="editManga(manga.slug)">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
				Edit
			</a>
		</td>
	</tr>
</template>

<script>
	export default {
		props: ['manga', 'i'],
		
		computed: {
			showMangaLink() {
				return `/admin/manga/${this.manga.slug}`
			}
		}
	}
</script>

<style lang="scss">
	
</style>