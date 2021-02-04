<template>
<div class="root">
    <h1>Info</h1>
    <hello-world msg="Dit is contact"></hello-world>
</div>
</template>

<script>
import HelloWorld from '../components/HelloWorld.vue'

export default {
    name: 'Contact',
    components: {
        HelloWorld
    },
    beforeRoueEnter (to,from,next){
        console.log("To",to);
        console.log('From',from);
        next();
    }
}
</script>
<style>
</style>