<template>
  <div class="home">
    
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <div class="col card1" v-for="film in films.slice(0,n)" :key="film.id">
        <div class="card card1">
          <router-link :to="{name:'Film', params:{id:film.id} } ">  <img :src="require(`@/assets/${film.img}`)"  class="card-img-top imgss" alt="..."></router-link>
          <div class="card-body">
            <p class="card-title filmNaam">{{film.naam}}</p>
            <p class="filmLand">Land: {{film.land}} || Jaar: {{film.jaar}}</p>
            <p class="card-text filmBeschrijving">{{film.beschrijving}}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="btn-group-toggle btn2" data-toggle="buttons" @click.prevent="showMore">
      <label class="btn btn-secondary active"> More </label>

    </div>

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
      n: 4,
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
      this.n += 4;
    },
  },

  mounted() {
    this.getFromDB();
  },
};
</script>

<style scoped>
#btn {
  text-decoration: none;
}

::-ms-backdrop{
    background-color: rgb(97, 97, 97);
}
.btn2 {
  text-align: center;
}
.router {
  text-decoration: none;
}
.imgss{
  background-color: blue;
  align-self: center;
  width: 401px;
  height: 596px;
}
.filmNaam{
  font-size: 29px;
  font-weight: bold;
  text-align: center;
}
.filmLand{
  font-size: 22px;
  font-weight: bold;
  text-align: center;
}
.filmBeschrijving{
  font-size: 22px;
}
.card1{
  margin-top: 20px;
}


</style>