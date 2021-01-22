<template>
  <div id="nav">
    <h1>To-Do List</h1>
        <to-do-form></to-do-form>
          <ul aria-labelledby="list-summary" class="stack-large">
            <li v-for="item in ToDoItems" :key="item.id">
              <to-do-item :label="item.label" :done="item.done"></to-do-item>
            </li>
          </ul>
  </div>
  <!-- <router-view/> -->
</template>

<script>
import ToDoItem from '@/components/ToDoItem.vue'
import uniqueId from 'lodash.uniqueid'
import ToDoForm from './components/ToDoForm';

export default {
  name:'app',
  components:{
    ToDoItem,
    // uniqueId
    ToDoForm
  },
  data(){
    return{
        ToDoItems: [
          { id:uniqueId('todo-') ,label: 'Learn Vue', done: false },
          { id:uniqueId('todo-') ,label: 'Create a Vue project with the CLI', done: true },
          { id:uniqueId('todo-') ,label: 'Have fun', done: true },
          { id:uniqueId('todo-') ,label: 'Create a to-do list', done: false }
      ]
    }
  }
}
</script>


<style>
*,
*::before,
*::after {
  box-sizing: border-box;
}

html {
  font: 62.5% / 1.15 sans-serif;
}
#app {
  background: #fff;
  margin: 2rem 0 4rem 0;
  padding: 2rem;
  padding-top: 0;
  position: relative;
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2.5rem 5rem 0 rgba(0, 0, 0, 0.1);
}

body {
  width: 100%;
  max-width: 68rem;
  margin: 0 auto;
  font: 1.6rem/1.25 "Helvetica Neue", Helvetica, Arial, sans-serif;
  background-color: #f5f5f5;
  color: #4d4d4d;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
}

.label-wrapper {
  margin: 0;
  flex: 0 0 100%;
  text-align: center;
}
[class*="__lg"] {
  display: inline-block;
  width: 100%;
  font-size :1.9rem;
}
[class*="__lg"]:not(:last-child) {
  margin-bottom: 1rem;
}
@media screen and (min-width: 620px) {
  [class*="__lg"] {
    font-size: 2.4rem;
  }
}

@media screen and (min-width: 550px) {
  #app {
    padding: 4rem;
  }
}
#app > * {
  max-width: 50rem;
  margin-left: auto;
  margin-right: auto;
}
#app > form {
  max-width: 100%;
}
#app h1 {
  display: block;
  min-width: 100%;
  width: 100%;
  text-align: center;
  margin: 0;
  margin-bottom: 1rem;
}
</style>
