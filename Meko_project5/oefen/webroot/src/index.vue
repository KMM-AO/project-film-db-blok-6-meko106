<template>
<div id="app">


  <div>
  <div class="mt-3" div="divGroup " >
    <b-card-group deck  id="cardGroup" class="mt-3">
      
      <b-card  bg-variant=" secondry light" v-for="film in films.length" :key="film.id" :img-src="film.img" img-height="300px"
      style="background-color:gray"
      text-variant="white" :header="film.naam" class="text-center">
        <b-card-text>Jaar : {{film.land}}</b-card-text>
                <b-card-text>Jaar : {{film.jaar}}</b-card-text>
        <b-card-text>Regisseur : {{film.regiseur}}</b-card-text>
        <b-card-text style="">Beschrijving: {{film.beschrijving}}</b-card-text>
      </b-card>
    </b-card-group>
  </div>
</div>


</div> 
</template>
<script>

export default { 
  components:{
  },

  name: 'app',
  props:{
    films:Array,
  },

  data(){
    return{
    n:4,
    countDivs:'',
    status:'TEST',
    }
  },

  methods:{  
    countt(par){
      if(par%2==0){
        var theDiv=document.querySelector('#group');
        theDiv.innerHTML='dfdfd';
        return true;
      }
    }
  },
  mounted(){
    this.nou();
        this.countDivElements();

  },
  computed(){
    this.countDivElements();
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







