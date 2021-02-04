<template>
<div class="root">

<!-- <h1>This is the person page</h1> -->

<div class="card" v-if="personData.length > 0">
  <div class="card-header">
    <h3> Naam: {{personData[0][0].naam}}</h3>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>Geboortedatum: {{personData[0][0].geboortedatum}}      </p>
    </blockquote>
  </div> 
</div>

</div>
</template>
<script>
export default {
    data(){
        return{
            personData:[]
        }
    },
    methods:{
        getPersonData(){
            fetch("http://localhost/project_jaar2/Meko_project5/applicatie/api/webroot/show_personData.php?persondata="+this.$route.params.id)
            .then((response) => response.json())
            .then((data) => this.personData=data)
            .then((data) => console.log(data))
        }
    },
    mounted(){
        this.getPersonData();
    },
  }
</script>

<style scoped>

</style>