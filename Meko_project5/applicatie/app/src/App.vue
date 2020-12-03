<template>
  <div>
    <the-nav></the-nav>
        <router-view /> 



  </div>
</template>
<script>
import TheNav from "@/components/TheNavigation.vue";
// import bodyNr from "@/components/bodyTow.vue";
// import goBack from "@/components/goback.vue";


export default {
  components: {
    TheNav,
    // bodyNr
    // goBack
  },
};
</script>



<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
