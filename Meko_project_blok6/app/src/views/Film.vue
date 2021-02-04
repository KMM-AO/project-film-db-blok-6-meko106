<template>
  <div class="app">
    <h1>Films Page</h1>

     <div class="card mb-3" style="max-width: 1400%">

        <div class="col-md-8">
          <div class="card-body">
            <h1 class="card-title">{{ filmsData.naam }}</h1>
            <h4 class="card-text">{{ filmsData.jaar }} | {{ filmsData.land }}</h4>
            <p class="card-text">{{ filmsData.beschrijving }}</p>
          </div>
        </div>

  </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            FilmId:this.$route.params.id,
            filmsData:[]
        }
    },
    methods:{
        getFromDB() {
            fetch("http://localhost/project_jaar2/blok6/project-film-db-blok-6-meko106/Meko_project_blok6/backend/public/ShowFilm/"+this.FilmId)
            .then((response) => response.json())
            .then((data) => (this.status = data))
            .then((data) => (this.filmsData = data.film))
            .then((data) => console.log(data));
        },
    },
    mounted(){
        this.getFromDB();
    }
};
</script>
<style>
</style>