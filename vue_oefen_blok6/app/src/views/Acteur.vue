<template>
<div class="root">
    <h1>This is the acteur page</h1>
    
    <div v-if="$route.params.id">
        <h2>ID is {{$route.params.id}}</h2>
        <button @click="goToProfile">Bekijk Profile</button>
        <h2>{{ getId }}</h2>
    </div>
    <router-view v-slot="{Component}" >
        <transition name="slide-left">
            <component :is="Component" />
        </transition>
    </router-view>
    </div>
</template>


<script>

export default {
    name:"Acteur",
    methods:{
        goToProfile(){
            console.log("test", this.getId);
            this.$router.push({path: `/acteur/${this.$route.params.id}/profile` });
        },
    },
    computed:{
        getId(){
            return this.$route.params.id;
        }
    }
}
</script>