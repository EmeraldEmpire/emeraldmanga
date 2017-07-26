<template>
	<tr>
		<td>{{ manga.name }} Ch - <a :href="chapterLink">{{ chapter.chap_num }}</a></td>
		<td class="actions">
			<button class="btn btn-danger" @click="$emit('deleteChapter', chapter, i)">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				Delete</button>
		</td>
	</tr>
</template>

<script>
	export default {
		props: ['chapter', 'i', 'manga'],

		data() {
			return {

			}
		},

		computed: {
			chapterLink() {
				return `/admin/manga/${this.manga.slug}/${this.chapter.num}`
			},
		},
	}
</script>

<style>
	
</style>