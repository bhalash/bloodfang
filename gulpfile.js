const concat = require('gulp-concat');
const gulp = require('gulp');
const rename = require('gulp-rename');
const replace = require('gulp-replace');
const sass = require('gulp-ruby-sass');
const sourcemap = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');

/* Asset Paths
 * -------------------------------------------------------------------------- */

var assets = {
  css: {
    source: 'scss/**/*.sass',
    dest: 'assets/',
    main: 'assets/style.css',
  },
  js: {
    source: 'js/*.js',
    concat: 'index.js',
    dest: 'assets/'
  },
  sprites: {
    source: 'assets/css/includes/**/*.svg',
    dest: 'assets/css/vectors'
  }
};

// Remove block comments from unminified output CSS.
var regex = {
  match: /^(\/\*|\s\*|\s{3}=).*[\n\r]/mg,
  replace: ''
};

/* Move Sprite Assets
 * -------------------------------------------------------------------------- */

gulp.task('sprites', function() {
  gulp.src(assets.sprites.source)
    .pipe(rename({ dirname: '' }))
    .pipe(gulp.dest(assets.sprites.dest));
});

/* Minify JS
 * -------------------------------------------------------------------------- */

gulp.task('js', () => {
  return gulp.src(assets.js.source)
    .pipe(uglify())
    .pipe(concat(assets.js.concat))
    .pipe(gulp.dest(assets.js.dest));
});

/* Production Minified CSS
 * -------------------------------------------------------------------------- */

gulp.task('css', () => {
  sass(assets.css.source, {
    emitCompileError: true,
    style: 'compressed'
  })
  .on('error', sass.logError)
  .pipe(gulp.dest(assets.css.dest));
});

/* Unminified CSS with Sourcemap
 * -------------------------------------------------------------------------- */

gulp.task('css-dev', ['sprites'], () => {
  return sass(assets.css.source, {
    emitCompileError: true,
    verbose: true,
    sourcemap: true
  })
  .on('error', sass.logError)
  .pipe(replace(regex.match, regex.replace))
  .pipe(sourcemap.write())
  .pipe(gulp.dest(assets.css.dest));
});

/* Watch Tasks
 * -------------------------------------------------------------------------- */

gulp.task('default', () => {
  gulp.watch(assets.css.source, ['css']);
});

gulp.task('dev', () => {
  gulp.watch(assets.css.source, ['css-dev']);
});
