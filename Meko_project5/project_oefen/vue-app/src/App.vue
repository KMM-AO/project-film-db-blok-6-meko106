<template>
  <div id="app">
    <employee-form :addnew="addEmployee"></employee-form>
    {{apicall}}
    <employee-table v-bind="employees"></employee-table>
  </div>
</template>

<script>
import EmployeeTable from '@/components/EmployeeTable.vue'
import EmployeeForm from '@/components/EmployeeForm.vue'

export default {
  name: 'App',
  components: {
    EmployeeTable,
    EmployeeForm
  },
  data(){
    return{
      employees:[
        {
        id:1,
        name:'Richard Henadikfd',
        email:'richard@gmail.dom'
        },
        {
          id:2,
          name:'mlinoo',
          email:'mlinoo@gmail.com'
        }
      ],
      apicall:""
    }
  },
  methods:{
    addEmployee(employee){
      const lastId= this.employees.length > 0 ? this.employees[this.employees.length -1]:
      0;
   const id = lastId + 1;
  const newEmployee = { ...employee, id };

  this.employees = [...this.employees, newEmployee];
},
async getEverything(){
  try{
      // C:\xampp\htdocs\project\project_oefen\vue-app\src\App.vue

    const response=await fetch('films.php');
    const data=await response.json();
    this.apicall=data;
    console.log(data);
}catch(error){
  this.apicall=error
}
}
},
mounted(){
this.getEverything();
}


}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
