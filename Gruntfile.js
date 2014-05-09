module.exports = function(grunt){
  var pkg = grunt.file.readJSON('package.json');

  // for compile less files
  var lessConfig = {
      development: {
        options: {
          compress: false
        },
        files: [
          {
            src: [
              './app/assets/stylesheets/tanzak.less'
            ],
            dest: './public/assets/stylesheets/tanzak.css'
          }
        ]
      }
  };

  grunt.initConfig({
    less: lessConfig,
  	watch: {
        less: {
          files: [
            './app/assets/stylesheets/*.less'
          ],
          tasks: ['less'],
          options: {
            liveoverload: true
          }
        },
      }
  });

  //matchdepでpackage.jsonから"grunt-*"で始まる設定を読み込む
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.registerTask('default', ['less', 'watch']);
  grunt.registerTask('publish', ['less']);
};
