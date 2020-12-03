<template>
  <div id="app">


    <!-- NAV Bar !-->
    <nav class="navbar navbar-light p-4 mb- bg-dark" id="nav1">
      <a class="navbar-brand" href="App.vue"> 
        <img src="./assets/filmm.png" alt="Los Angeles" style="width:90%;">
      </a>
    <!--  FORM !-->
    <form class="form-inline col-8" id="form1">
      <div>     <!-- SELECT element !-->

      <b-form-select v-model="selected" :options="categorieOptions"></b-form-select>
      </div>
    <!-- Input -->
    <input type="text" placeholder="Search" v-model="inputField"> 
    <button class="btn btn-outline-success my-2 my-sm-3" id="search" type="button" @click.prevent="nou"  >Search</button>

    </form>   <!-- FROM EINDE --> 
    </nav>

    <div class="ifdiv">
    <index-page :films=films class="div4"> </index-page>  
    </div>  
    
    <pre>{{status}}</pre>
  </div> 
</template>


<script>
import indexPage from './index.vue'

export default { 
  name: 'app',
  components: {
    indexPage,
  },
  data(){
    return{
      status:'Check',
      inputField:"",
      selected:'Categorie',
      films:[],
      nr:2,
      categorieOptions: [
        { value: 'Categorie', text: 'Categorie' },
        { value: 'Celebs', text: 'Celebs' },
        { value: 'Films', text: 'Films' },
        { value: 'TV Episodes', text: 'TV Episodes' },
      ]
    }
  },
  methods:{  
    nou:function() {
      this.status=this.selected;
       fetch('http://localhost/project/Meko_project5/applicatie/webroot/public/films.php?cat='+this.selected)
      .then( (response) => response.json() )  
      .then((data) => this.films=data)
    }
  },
  mounted(){
    this.nou();
      },
}




</script>

<style>

.div4{
  background-color: rgb(43, 42, 42);
    height: 700px;
    justify-content: space-between;
}

#form1{
  justify-content: space-around;
} 
#search{
  background-color: rgb(255, 255, 255);
  color: rgb(98, 98, 98);
}
.div5{
  height: 200px;
}
.indexDiv{
  justify-content: space-between;
  display:flex;
  /* align-items: center; */
}

</style>