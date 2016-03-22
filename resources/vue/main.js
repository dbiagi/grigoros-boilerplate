var Vue = require('vue');
var UsersTable = require('./table.vue');

new Vue({
  el: "body",
  components: {
    "users-table": UsersTable
  }
});
