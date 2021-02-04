<template>
<div>

</div>
</template>


<script>
export default {
    name: 'PostNew',
    beforeRouterEnter:(to,from,next) =>{

        if(!to.meta.loggedIn){
            next(from.path);
        }else{
            next();
        }
        next();
        }
    }
</script>
<style>





</style>