<template>
<div class="root">

<!-- <h1>{{$route.params.film_name}}</h1>
<h1>{{$route.params.categorie}}</h1> -->
<div class="showindex" v-if="searchData.length ==0">
    <h1> "{{$route.params.film_name}}" not found in {{$route.params.categorie}} </h1>
    </div>
    <div v-else>
        <div class="list-group" v-if="$route.params.categorie=='Films'">
            <router-link :to="{name:'Films', params:{id:`${searchData[0].id}` } }" class="list-group-item list-group-item-action">{{searchData[0].naam}}</router-link>
        </div>
        
        <div v-else-if="$route.params.categorie=='Acteurs' ">
            Acteur: <router-link :to="{ name: 'Person', params: { id:`${searchData[0].id }` } }"> {{  searchData[0].naam }},  </router-link>
        </div>

        <div v-else-if="$route.params.categorie=='Regisseurs' ">
            Regisseur: <router-link :to="{ name: 'Person', params: { id:`${searchData[0].naam }` } }"> {{  searchData[0].naam }},  </router-link>
        </div>
    </div>


    <!-- <pre>{{searchData}}</pre> -->
</div>
</template>

<script>
export default {
    data(){
        return{
            searchData:[]
        }
    },
    methods:{
        showIndex(){
            fetch("http://localhost/project_jaar2/Meko_project5/applicatie/api/webroot/show_acteurs_json.php?name="+this.$route.params.film_name+"&categorie="+this.$route.params.categorie)
            .then((response) => response.json())
            .then((data) => this.searchData=data)
            .then((data) => console.log(data))
        },
    },
    mounted(){
        this.showIndex();
    },
}
</script>

<style scoped>

</style>