<template>
  <div>
    <input type="checkbox" :id="nieId" :checked="isDone" />
    <label for="todo-item">{{label}}</label>
  </div>
</template>

<script>
// import uniqueId from 'lodash.uniqueid'; defiendd

  export default {
    props: {
      label: { required: true, type: String },
      done: { default: false, type: Boolean },
      id:{required:true}
    },
    data(){// to manage local stata in a component
    return{
        isDone:this.done, // you use this to acces the proprties
        //to bind an instance properties to an component attrribute
        //we use v-bind
        // nieId:uniqueId// zo wordt er hier altijd een unieke id gemaakt

    }

    }
  };
</script>

<style>

</style>