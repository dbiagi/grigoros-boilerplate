<style>
    .red {
        color: #f00;
    }
</style>

<template>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    module.exports = {
        data: function() {
            return {
                users: [
                    { id: 1, name: "Test 1", email: "diego@invalid.com" },
                    { id: 2, name: "Test 2", email: "diego@invalid.com" },
                    { id: 3, name: "Test 3", email: "diego@invalid.com" },
                    { id: 4, name: "Test 4", email: "diego@invalid.com" },
                    { id: 5, name: "Test 5", email: "diego@invalid.com" },
                ]
            }
        }
    }
</script>
