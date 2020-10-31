<template>
<form @submit="onSubmit">
    <label for="new-todo-input">
      What needs to be done?
    </label>
    <input
      type="text"
      id="new-todo-input"
     2 name="new-todo"
      autocomplete="off"
      v-model="label"
    />
    <button type="submit">
      Add
    </button>
  </form>
</template>

<script>
export default {
   methods: {
       onSubmit() {
        //   console.log('form submitted')
        this.$emit("fun",this.label);// no spaces
       }//$emit(event name)
       // the event name should be invokeld by the todoform element
       //adding the data you want to want to pass with the event name
   },
   data(){
       return{
           label:""
       }
   }
}
</script>

<style>

</style>