<template>
  <div class="root">
    
    
    <!--  Film titles page -->
    
    <h1>This the home page Tenet</h1>

    <div class="list-group" v-for="film in films.slice(0,n)" :key="film.id">
      <router-link :to="{name:'Films', params:{id:film.id} }" class="list-group-item list-group-item-action">{{film.naam}}</router-link>
    </div>
    <div class="btn-group-toggle" data-toggle="buttons" @click.prevent="showMore">
  <label class="btn btn-secondary active">
    <input type="checkbox" checked>More 
  </label>
</div>

<!-- {{status}} -->


</div>
</template>
<script>

export default {
  data() {
    return {
      films: [],
      status: "",
      n:5
    };
  },
  methods: {
    showMore(){
      this.n+=5;
    },
    getFromDB() {  
      fetch("http://localhost/project_jaar2/Meko_project5/applicatie/api/webroot/show_json.php")
        .then((response) => response.json() )
        .then((data) => (this.status = data))
        .then((data) => this.films=data )
        .then((data) => console.log(data));
    },
  },
  mounted() {
    this.getFromDB();
  },
};



</script>




