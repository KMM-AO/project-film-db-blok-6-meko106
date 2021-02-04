<template>
<div class="employee-table">
    <table>
        <thead>
            <tr v-for="employee in employees" :key="employee.id">
                <th>{{employee.name}}</th>
                <th>{{employee.email}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>dfjdfd</td>
            <td>Richard dHendrics</td>
            </tr>
            <tr>
            <td>dfjdfd</td>
            <td>Patrcik dHendrics</td>
            </tr>
        </tbody>
    </table>
</div>
</template>


<script>
export default {
    name: 'employee-table',
    props:{
        employees:Array
    }
}
</script>


<style scoped>

</style>