// gulp dependencies
var gulp = require('gulp');
var uglify = require('gulp-uglify');
var cssnano = require('gulp-cssnano');
var sass = require('gulp-sass');
var useref = require('gulp-useref');
var autoprefixer = require('gulp-autoprefixer');
var imagemin = require('gulp-imagemin');
var rename = require("gulp-rename");

// browser-sync watched files
// automatically reloads the page when files changed
var browserSyncWatchFiles = [
    './css/*.css',
    './js/app.min.js',
    './**/*.php'
];

// browser-sync options
// see: https://www.browsersync.io/docs/options/
var browserSyncOptions = {
    proxy: "localhost/beew/impulsa",
    notify: false
};

// Defining requirements
var browserSync = require('browser-sync').create();

// Run:
// gulp browser-sync
// Starts browser-sync task for starting the server.
gulp.task('browser-sync', function() {
    browserSync.init(browserSyncWatchFiles, browserSyncOptions);
});

// css changes task
gulp.task('css', function() {
  return gulp.src('./css/**/*.css')
    .pipe(browserSync.stream({match: '**/*.css'}));
});

// Watchers
gulp.task('watch', function() {
  gulp.watch('./css/**/*.scss', gulp.series('sass'));
  gulp.watch('./css/**/*.css', gulp.series('css'));
  gulp.watch('./*.html', browserSync.reload);
  gulp.watch('./*.php', browserSync.reload);
  gulp.watch('./js/app.js', gulp.series('js'));
});

// sass and compress css
gulp.task('sass', function() {
  return gulp.src('./css/screen.scss') // Gets all files ending with .scss in app/scss and children dirs
    .pipe(sass()) // Passes it through a gulp-sass
    .pipe(cssnano())
    .pipe(autoprefixer({ cascade: false }))
    .pipe(gulp.dest('./css/')) // Outputs it in the css folder
    .pipe(browserSync.stream({match: '**/*.css'}));
});

// compress js
gulp.task('js', function() {
  return gulp.src('./js/app.js') // Gets all files ending with .scss in app/scss and children dirs
    .pipe(uglify()) // Passes it through a gulp-sass
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./js/')) // Outputs it in the css folder
    .pipe(browserSync.stream({match: './js/app.js'}));
});

// start tasks
gulp.task('start', gulp.parallel('browser-sync', 'sass', 'js', 'watch'));

// minify images
gulp.task('images-min', function() {
    gulp.src('./images/*')
      .pipe(imagemin())
      .pipe(gulp.dest('./dist/images'))
});