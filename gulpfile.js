var gulp = require('gulp'),
	concat = require('gulp-concat'), // 合併檔案
    uglify = require('gulp-uglify'), // 壓縮 JS
    minifyCSS = require('gulp-minify-css'),
    order = require('gulp-order'),
    livereload = require("gulp-livereload"),
    rename = require("gulp-rename"),
    gulpif  = require("gulp-if");

var production = false; // Production status

gulp.task('uglify:js', function(){
    return gulp.src(['src/scripts/*.js', 'src/scripts/**/*.js'])
        .pipe(order([
            "jquery.min.js",
            "plugins/bootstrap.bundle.js",
            '*.js'
        ]))
        .pipe(concat('funcs.js'))
        .pipe(gulpif(production, uglify()))
        .pipe(rename(function(path) {
            path.basename += ".min";
            path.extname = ".js";
        }))
        .pipe(gulp.dest('web/assets/scripts'))
        .pipe(livereload()); 
});

gulp.task('uglify:css', function(){
    return gulp.src('src/style/funcs/*.css')
        .pipe(concat('funcs.css'))
        .pipe(gulpif(production, minifyCSS()))
        .pipe(rename(function(path) {
            path.basename += ".min";
            path.extname = ".css";
        }))
        .pipe(gulp.dest('web/assets/style'))
        .pipe(livereload()); 
});

gulp.task('minify:css', function(){
    return gulp.src('src/style/*.css')
        .pipe(gulpif(production, minifyCSS()))
        .pipe(rename(function(path) {
            path.basename += ".min";
            path.extname = ".css";
        }))
        .pipe(gulp.dest('web/assets/style'))
        .pipe(livereload()); 
});

gulp.task('watch', function () {
  gulp.watch('src/scripts/*.js', ['uglify:js']);
  gulp.watch('src/scripts/**/*.js', ['uglify:js']);
  gulp.watch('src/style/funcs/*.css', ['uglify:css']);
  gulp.watch('src/style/*.css', ['minify:css']);
  livereload.listen();
});

gulp.task('default',['uglify:js','uglify:css', 'minify:css', 'watch']);