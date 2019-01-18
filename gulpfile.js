var url = 'll_start.dev.cc'; // Local dev URL. Change as needed.

var gulp = require('gulp'),
  browserSync = require('browser-sync'),
  reload = browserSync.reload,
  autoprefixer = require('gulp-autoprefixer'),
  cleanCSS = require("gulp-clean-css"),
  concat = require('gulp-concat'),
  imagemin = require('gulp-imagemin'),
  minifyCSS = require('gulp-minify-css'),
  notify = require('gulp-notify'),
  plumber = require('gulp-plumber'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  uglify = require('gulp-uglify');

gulp.task('bs', function () {
  browserSync.init({
    proxy: url
  });
});

gulp.task('styles', function () {
  return gulp.src('./sass/**/*.scss')
    .pipe(plumber({
      errorHandler: notify.onError("Error: <%= error.message %>")
    }))
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(minifyCSS())
    .pipe(autoprefixer({
      grid: true,
      browsers: [
        'last 1 version',
        'not dead',
        '> 1%'
      ]
    }))
    .pipe(
      cleanCSS({
        level: {
          2: {
            mergeAdjacentRules: true, // controls adjacent rules merging; defaults to true
            mergeIntoShorthands: true, // controls merging properties into shorthands; defaults to true
            mergeMedia: true, // controls `@media` merging; defaults to true
            mergeNonAdjacentRules: true, // controls non-adjacent rule merging; defaults to true
            mergeSemantically: false, // controls semantic merging; defaults to false
            overrideProperties: true, // controls property overriding based on understandability; defaults to true
            removeEmpty: true, // controls removing empty rules and nested blocks; defaults to `true`
            reduceNonAdjacentRules: true, // controls non-adjacent rule reducing; defaults to true
            removeDuplicateFontRules: true, // controls duplicate `@font-face` removing; defaults to true
            removeDuplicateMediaBlocks: true, // controls duplicate `@media` removing; defaults to true
            removeDuplicateRules: true, // controls duplicate rules removing; defaults to true
            removeUnusedAtRules: false, // controls unused at rule removing; defaults to false (available since 4.1.0)
            restructureRules: false, // controls rule restructuring; defaults to false
            skipProperties: [] // controls which properties won't be optimized, defaults to `[]` which means all will be optimized (since 4.1.0)
          }
        }
      })
    )
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./'))
    .pipe(reload({
      stream: true
    }));
});

gulp.task('scripts', function () {
  return gulp.src('./js/*.js')
    .pipe(sourcemaps.init())
    .pipe(plumber({
      errorHandler: notify.onError("Error: <%= error.message %>")
    }))
    .pipe(concat('main.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./public/scripts'))
    .pipe(reload({
      stream: true
    }));
});

gulp.task('images', function () {
  return gulp.src('./images/**/*')
    .pipe(
      imagemin({
        progressive: true,
        svgoPlugins: [{
          removeViewBox: false
        }]
      })
    )
    .pipe(gulp.dest('./images'));
});

gulp.task('watch', function () {
  gulp.watch('sass/**/*.scss', ['styles']);
  gulp.watch('./js/**/*.js', ['scripts']);
  gulp.watch('./**/*.php', reload);
});

gulp.task('default', ['styles', 'scripts', 'images', 'bs', 'watch']);