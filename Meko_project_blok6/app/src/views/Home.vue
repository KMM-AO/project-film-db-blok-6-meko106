<template>
  
  <div class="home">
    <div class="list-group" v-for="film in films.slice(0, n)" :key="film.id">
      <router-link class="router" :to="{ name: 'Film', params: { id: film.id } }" >
        <li class="list-group-item text-center list-group-item-action">
          {{ film.naam }}
        </li>
      </router-link>
    </div>

    <div class="btn-group-toggle btn2" data-toggle="buttons" @click.prevent="showMore">
      <label class="btn btn-secondary active"> More </label>
    </div>
    <router-view />

  </div>
</template>


<script>
export default {
  components: {
  },
  data() {
    return {
      status: [],
      films: [],
      n: 5,
    };
  },

  methods: {
    getFromDB() {
      fetch(
        "http://localhost/project_jaar2/blok6/project-film-db-blok-6-meko106/Meko_project_blok6/backend/public/IndexFilms"
      )
        .then((response) => response.json())
        .then((data) => (this.status = data))
        .then((data) => (this.films = data.films))
        .then((data) => console.log(data));
    },
    showMore() {
      this.n += 5;
    },
  },

  mounted() {
    this.getFromDB();
  },
};
</script>

<style>
#btn {
  text-decoration: none;
}

.btn2 {
  text-align: center;
}

.router {
  text-decoration: none;
}
</style>