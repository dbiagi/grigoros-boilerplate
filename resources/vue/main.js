var Vue = require('vue');
var DataTable = require('./table.vue');

Vue.config.debug = true;

new Vue({
  el: "body",
  components: {
    "data-table": DataTable
  }
});
