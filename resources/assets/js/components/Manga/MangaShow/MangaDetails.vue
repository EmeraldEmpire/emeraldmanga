<template>
	<div class="inner-details col-md-12">
		
		<div class="manga-details-edit">
			<button class="btn btn-default" @click="toggleEdit">
				<span class="glyphicon" :class="toggleIcon" aria-hidden="true"></span>
				{{ toggleEditText }}
			</button>
			<button class="btn btn-success" 
				v-show="isUpdating"
				@click="updateManga">
				<span class="glyphicon glyphicon-save"></span>
				Save
			</button>
		</div>
		

		<figure class="cover">
			<img :src="manga.cover_path" :alt="manga.name">
		</figure>
		
		<ul class="col-xs-8" v-show="!isUpdating">
			<li class="actions">
				<p>Genre(s): </p>
				<a v-for="genre in manga.genres" href="">{{ genre.name }} </a>
			</li>
			<li>
				<p>Author(s): </p>
				<a v-for="author in manga.authors" href="">{{ author.name }} </a>
			</li>
			<li>
				<p>Artist(s): </p>
				<a v-for="artist in manga.artists" href="">{{ artist.name }} </a>
			</li>
			<li>
				<p>Synopsis / Description: </p> 
				<h5 class="well">{{ manga.description }}</h5>
			</li>
		</ul>

		<form class="col-xs-8 update-form" v-show="isUpdating">

			<div class="form-group">
				<label for="name">Name / Title</label>
				<input type="text" class="form-control" v-model="name">
				<label for="genres">Genre(s)</label>
				<select id="genres" class="form-control select2-multi select2-genres"
					style="width:100%;"
					multiple
					v-model="selectedGenres">
					<option v-for="genre in genres" :value="genre.id">{{ genre.name }}</option>
				</select>
			</div>

			<div class="form-group">
				<label for="authors">Author(s)</label>
				<select id="authors" class="form-control select2-multi select2-authors"
					style="width:100%;" 
					multiple
					v-model="selectedAuthors">
					<option  
						v-for="author in authors" 
						:value="author.id">{{ author.name }}</option>
				</select>
			</div>

			<div class="form-group">
				<label for="artists">Artist(s)</label>
				<select id="artists" class="form-control select2-multi select2-artists"
					style="width:100%;"
					multiple
					v-model="selectedArtists">
					<option  
						v-for="artists in artists" 
						:value="artists.id">{{ artists.name }}</option>
				</select>
			</div>

			<div class="form-group">
				<label for="description">Synopsis / Description</label>
				<textarea class="form-control test2" id="description" style="resize:none;"
					v-model="description"></textarea>
			</div>
		</form>

	</div>
</template>

<script>
	export default {
		props: ['manga', 'genres','authors', 'artists'],

		data() {
			return {
				selectedGenres: this.manga.genres.map((selected) => selected.id),
				selectedAuthors: this.manga.authors.map((selected) => selected.id),
				selectedArtists: this.manga.artists.map((selected) => selected.id),
				description: this.manga.description,
				name: this.manga.name,
				isUpdating: false
			}
		},

		methods: {
			updateManga() {
				let data = { 
					name: this.name,
					description: this.description,
					genres: this.selectedGenres,
					authors: this.selectedAuthors,
					artists: this.selectedArtists
				}

				this.$emit('updateManga', data)
			},

			onSelectGenres() {
				let selected = $('.select2-genres').val().map((selected) => parseInt(selected))
				this.selectedGenres = selected
			},

			onSelectedAuthors() {
				let selected = $('.select2-authors').val().map((selected) => parseInt(selected))
				this.selectedAuthors = selected
			},

			onSelectedArtists() {
				let selected = $('.select2-artists').val().map((selected) => parseInt(selected))
				this.selectedArtists = selected
			},

			toggleEdit() {
				this.isUpdating = !this.isUpdating
			},

			updated() {
				this.isUpdating = !this.isUpdating
			}
		},

		computed: {
			toggleIcon() {
				return ( this.isUpdating ? 'glyphicon-remove' : 'glyphicon-edit' )
			},

			toggleEditText() {
				return ( this.isUpdating ? 'Cancel' : 'Edit' )
			}
		},

		created() {
			Bus.$on('updated', this.updated)
		},

		mounted() {
			$('.select2-genres').on('change', this.onSelectGenres)
			$('.select2-authors').on('change', this.onSelectedAuthors)
			$('.select2-artists').on('change', this.onSelectedArtists)
		}

	}
</script>

<style lang="scss">

.manga-details-edit {
	position: absolute;
	right: 0;
}

.inner-details {
	ul {
		list-style: none;
		margin-top: 70px;
		float: left;
		li {
			a {
				text-decoration: none;
			}

			h5 {
				margin: 0;
			}
		}
		
	}

	p {
		display: inline-block;
		font-weight: 700;
	}
}

.cover {
	display: inline-block;
	height: 354px;
	width: 254px;
	border: 2px solid #e5e5e5;
	float: left;
	img {
		max-height: 350px;
		max-width: 250px;
		display: inline-block;
	}
}

.update-form {
	margin-top: 70px;
}

</style>