<template>

<div class="employee-from">
    <form @submit.prevent="handel">
        <label>EmployeeName</label>
        <input type="text" v-model="employee.name"> 
        <label>EmployeeForm</label>
        <input type="text" v-model="employee.email">
        <button>Add</button>
    </form>
</div>
</template>


<script>
export default {
    name:'employee-form',
    data(){
        return{
            employee:{
                name:'',
                email:'',
            },
        }
    },
    methods:{
        handel(){
            console.log("function test");
            this.$emit("addnew",this.employee)
        }
    }
}
</script>

<style scoped>
form{
    margin-bottom: 2rem;
}
</style>