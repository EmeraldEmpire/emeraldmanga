<template>
	<tr>
		<td>{{ manga.name }} Ch - <a :href="chapter.href">{{ chapter.chapter_num }}</a></td>
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
	}
</script>

<style>
	
</style>