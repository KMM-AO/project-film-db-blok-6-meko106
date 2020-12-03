<template>
<div id="app">
  
  
  <b-card-group col id="group" >

    <b-card  v-for="film in films" :key="film.id" 
    :title="film.naam"
    style="max-width:40% ; margin-top:20px">
    <b-card-text>
      {{film.beschrijving}}
    </b-card-text>

    <b-link to="perso">
     <b-button variant="primary">{{film.regiseur}}</b-button> </b-link>
  </b-card>
  </b-card-group>
  <!-- </div> -->

<person></person>

</div> 
</template>


<script>
import person from './perso.vue';

export default { 
  components:{
    person,
  },

  name: 'app',
  props:{
    films:Array,
  },
  methods:{  
    nou() {
      var groupElement=document.querySelector('#group');
      if(this.films.length ===3){
        groupElement.innerHTML+='<br>';
      }
    },
    shareData(){
      this.$router.push(name:"Users",params);
    }
  
  },
  mounted(){
    this.nou();

      },
}



</script>




<style scoped>
.divClass{
  justify-content: space-between;
  display: content;

}
.div9{
  align-self: center;
  align-content:center; display: flex;
  float: left;
  width: 15rem;
  margin: 60px;
}

[id|='2'] {
  background: yellow;
  width: 25rem;
  height: 35rem;
  margin-top: 40px;
}
</style>







