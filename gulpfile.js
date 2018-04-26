'use strict';

var gulp      = require('gulp');
var sass      = require('gulp-sass');
var cleanCSS  = require('gulp-clean-css');
var concat 	  = require('gulp-concat');
var uglify    = require('gulp-uglify');
var plumber   = require('gulp-plumber');
var browserSync = require('browser-sync').create();

// Path to custom files
var config = {
  sassPath:   './assets/scss/*.scss',
  scriptPath: './assets/js/*.js'
}

gulp.task('sass', function () {
  	return gulp.src([config.sassPath])
      .pipe(plumber({
          errorHandler: function (err) {
              console.log(err);
              this.emit('end');
          }
      }))
    	.pipe(sass())
      .pipe(cleanCSS( {compatibility: 'ie8'} ))
    	.pipe(gulp.dest('./assets/css'))
});

gulp.task('scripts', function() {
	return gulp.src([
      'node_modules/jquery/dist/jquery.min.js',
      'node_modules/bootstrap/dist/js/bootstrap.min.js',
      './assets/js/app.js',
    ])
    .pipe( concat('scripts.js') )
    .pipe( uglify() )
    .pipe( gulp.dest('./assets/js/') )
});

gulp.task('watch', function() {
  gulp.watch([config.sassPath, config.scriptPath], ['sass', 'scripts']);
});


gulp.task('watch-sass', function() {
  gulp.watch([config.sassPath], ['sass']);
});


gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "wordpress.local",
    });

    gulp.watch([config.sassPath], ['sass']).on('change', browserSync.reload);
    gulp.watch("*.php").on('change', browserSync.reload);
});