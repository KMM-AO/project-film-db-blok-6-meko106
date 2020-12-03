<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
    <div>
      <h2>Counter</h2>
      <p>{{getCount}}</p>
    <div>
      <button @click.prevent="addOne"> Ophogen  </button>
    </div>
    <p>Conter Times 2{{getTimes}}</p>
    </div>
    <div>
      <h2>User is {{getName}}</h2>
      <div>
        <label for="name">Naam</label>
      <input type="text"
      name="name"
      id="name"
      placeholder="vul je naam in"
      @input="getUsername"
      >

      </div>
    </div>
    <div>
      <h1>Views</h1>
      <p>{{views.it1}}</p>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'
import {mapGetters, mapState} from 'vuex'

export default {
  name: 'Home',
  components: {
    HelloWorld
  },
  methods:{
    addOne(){
      this.$store.commit('increment');
    },
    getUsername(ev){
      this.$store.commit('changeUser',ev.target.value);
    },
    test(){

    }
  },
  computed:{
    // getCount(){
    //   return this.$store.state.count
    // },
    // getTime(){
    //   return this.$store.getters.conunt2x
    // },
    // getName(){
    //   return this.$store.state.user
    // },
    ...mapState(['count','user','loading','views']),
    // getTime(){
    //   return this.$store.getters.countex
    // },
    ...mapGetters(['count2x'])                                                                                                                                         
  }
}
</script>
