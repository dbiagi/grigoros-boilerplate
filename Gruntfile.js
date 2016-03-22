module.exports = function (grunt) {
    var log = grunt.log.writeln;

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            scripts: {
                files: ['vue/*.vue', 'vue/main.js'],
                tasks: ['vueify'],
                options: {
                    spawn: false
                }
            }
        },
        vueify: {
            input: 'vue/main.js',
            output: 'web/js/build.vue.js'
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('vueify', 'Build vue files.', function () {
        var exec = require('child_process').exec,
            done = grunt.task.current.async(),
            config = grunt.config('vueify'),
            command = 'browserify -t vueify -e ' + config.input + ' -o ' + config.output;
        log(command);
        exec(command, function (error, stdout, stderr) {
            log(stdout);
            done(error);
        });
        // browserify -t vueify -e vue/main.js -o web/build.js
    });
};