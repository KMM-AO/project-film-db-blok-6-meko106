<template>
  <div class="app">
    
    <div class="card mb-3" style="height: 1900px">
      
      <div class="row g-0" v-if="filmsData.length !== 0">
        <div class="col-md-4">
          <img :src="require(`@/assets/${filmsData.img}`)"  class="card-img-top imgss" alt="...">
        </div>
        <div class="col-md-8 info">
          <div class="card-body">
            <p class="card-title filmNaam">{{ filmsData.naam }}</p>
            <p class="card-text filmLand">Jaar: {{ filmsData.jaar }} || Land: {{ filmsData.land }}</p>
            <p class="card-text filmBeschrijving">{{ filmsData.beschrijving }}</p>
            
            <p class="regisseur"> Regisseur:
              <router-link to="person" class="routerlink"> 
                <span class="regisseurNaam">{{filmsData.regisseur[0].naam}}</span>
              </router-link>
            </p>
              
              
            <p class="acteur">Acteurs:
              <router-link v-for="n in filmsData.acteurs" :key="n.id" to="persons" class="routerlink">
                <span class="regisseurNaam">{{n.naam}}</span>,
              </router-link> 
            </p>

          </div>
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
<style scoped>
*{
    background-color: rgb(97, 97, 97);
}
.routerlink{
  text-decoration: none;
}
.filmNaam{
  font-size: 80px;
  color: white;
}
.filmBeschrijving{
  font-size: 33px;
  color: white;
}
.filmLand, .regisseur, .acteur{
  color: white;
  font-weight: bold;
  font-size: 33px;
}
.imgss{
  width: 401px;
  height:596px;
}
.info{
  width: 1088px;
}
.regisseurNaam{
  font-weight: normal; 
}
</style>