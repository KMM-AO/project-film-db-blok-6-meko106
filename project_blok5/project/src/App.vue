<template>
  <div id="app">
    

    <!-- NAV Bar !-->
    <nav class="navbar navbar-light p-4 mb- bg-secondary" id="nav1">
      <a class="navbar-brand" href="#"> 
        <img src="./assets/filmm.png" alt="Los Angeles" style="width:90%;">
      </a>


    <!--  BUTTON !-->
    <form class="form-inline col-8" id="form1">
      <div>     <!-- SELECT element !-->
      <b-form-select v-model="selected" :options="categorieOptions"></b-form-select>
      </div>


    <!-- Input -->
    <input type="text" placeholder="Search" v-model="inputField"> 
    <button class="btn btn-outline-success my-2 my-sm-3" id="search" type="button" @click="getAllUsingCategorieName()">Search</button>




    </form> 
    </nav>

    {{status}}

    <div class="div5">

    </div>


    <index-page> </index-page>
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
      users:"",
      info:null,
      inputField:"",
      selected:'Categorie',
      categorieOptions: [
        { value: 'Categorie', text: 'Categorie' },
        { value: 'Celebs', text: 'Celebs' },
        { value: 'Films', text: 'Films' },
        { value: 'TV Episodes', text: 'TV Episodes' },
      ]
    }
  },
  methods:{
    getAllUsingCategorieName: function () {
      this.status="Loading...";
      var vm=this;
      this.axios.get("./films.php")
      .then(function(response){
        vm.status=response.data;
      })
      .catch(function(error){
        console.log('Fout melding: '+error);
      })


    }
  }
};



</script>

<style>
.div2{
  background-color: blueviolet;
  /* color: blue; */
  
}
.div4{
  background-color: rgb(0, 0, 0);
  height: 400px;
}
.Items{
  background-color: gray;
  height: 605px;
}
#form1{
  justify-content: space-around;
} 
#search{
  background-color: rgb(255, 255, 255);
  color: rgb(98, 98, 98);
}

.div3{
  display: flex;
  background-color: green;
}
.div5{
  height: 200px;
}

</style>