<template>
<div class="root">
    <h1>{{$route.params.id}}</h1>
    <section class="destination">
        <h1>{{destination.name}}</h1>
        <div class="destination-details">
            <img :src="require(`@/assets/${destination.image}`)" :alt="destination.name" >
        </div>
    </section>
</div>
</template>

<script>

import store from "@/store.js"
export default {

    data(){
        return{
            destinationId:this.$route.params.id
        }
    },
    computed:{
        destination(){
            return store.destinations.find(
                destination => destination.id===this.destinationId
            )
        }
    }
}
</script>

<style scoped>

p{
    margin: 0 40px;
    font-size: 20px;
    text-align: left;
}
.destination-details{
    display: flex;
    justify-content: space-between;
}
img{
    max-width:600px;
    height: auto;
    width: 100%;
    max-height: 400px;
}

</style>