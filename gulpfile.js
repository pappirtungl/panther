var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));
var cleanCSS = require('gulp-clean-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var order = order = require('gulp-order');
var browserSync = require('browser-sync').create();

gulp.task('styles', function() {
      return gulp.src('assets/css/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' })) 
        .pipe(gulp.dest('dist')) 
        .pipe(browserSync.reload({      
             stream: true     
         }));
});

gulp.task('scripts', function() {
      return gulp.src('assets/js/*.js')
        .pipe(order(['jquery.js', '*.js']))
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('dist'))
        .pipe(browserSync.reload({
             stream: true
         }));
}); 

gulp.task('watch', function() {   
      browserSync.init({
         proxy: "http://localhost/panther/"
});

gulp.watch('assets/css/**/*.scss', gulp.series('styles'));
gulp.watch('assets/js/*.js', gulp.series('scripts'));
gulp.watch('**/*.php').on('change', browserSync.reload); });
gulp.task('default', gulp.parallel('styles', 'scripts', 'watch'));