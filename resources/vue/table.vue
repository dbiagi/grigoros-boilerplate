<style>
    .red {
        color: #f00;
    }
</style>

<template>
    <div>
        <h2>{{ data.title }}</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th v-for="h in headers">{{ h }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in data.collection">
                    <td v-for="val in row">
                        {{ val }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    module.exports = {
        props: {
            data: {
                type: Object,
                required: true
            }
        },
        computed: {
            headers: function () {
                if (this.data.collection.length > 0) {
                    return _.keys(this.data.collection[0]);
                }

                return [];
            }
        }
    }
</script>