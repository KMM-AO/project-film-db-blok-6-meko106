<template>
  <div class="body"> 
    

    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <router-link to="/" class="#">Home</router-link>
  <!-- <router-link to="Person" >Person</router-link> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <!-- <router-link to="Home" class="nav-link" ><span class="sr-only">(current)</span></router-link> -->
      </li>
    </ul>

    
    <form class="form-inline my-2 my-lg-0">
  

 <select class="form-control" v-model="status" >
  <option value="Categorie">Categorie</option>
  <option>Films</option>
  <option>Acteurs</option>
  <option>Regisseurs</option>
</select>

  
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="input">
      <router-link :to="{name:'FilmsSearch',params:{film_name:input, categorie:status }}" >
      <button class="btn btn-outline-light  my-2 my-sm-0" type="submit" >Search</button>
      </router-link>
    </form>
  </div>
</nav>
<!-- {{status}} -->
<!-- {{input}} -->



  </div>
</template>

<script>
export default {
  name: "app",
  data(){
    return{
      status:'Categorie',
      input:'.'
    }
  },
};
</script>

<style scoped>

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #0e0f10;
}
li {
  padding: 0 10px;
}
nav a.router-link-exact-active {
  color: #ffffff;
}
</style>