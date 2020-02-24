const gulp = require('gulp');
const uglify = require('gulp-uglify');
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const imagemin = require('gulp-imagemin');
const pump = require('pump');
const uglifycss = require('gulp-uglifycss');
const rename = require('gulp-rename');
const htmlmin = require('gulp-htmlmin');
const concatCss = require('gulp-concat-css');
const svgSprite = require('gulp-svg-sprite');
const rev = require('gulp-rev-append');

const srcFolder = './src/'
const dstFolder = './static/'

const paths = {
  styles: {
    src: srcFolder.concat('styles/main.scss'),
    watchSrc: srcFolder.concat('styles/*'),
    includes: [
      'node_modules/bootstrap/scss',
      'node_modules/@fortawesome/fontawesome-free/scss',
      'node_modules/slick-carousel/slick',
    ],
    dest: dstFolder.concat('styles/'),
  },
  scripts: {
    src: [
      'node_modules/jquery/dist/jquery.slim.min.js',
      'node_modules/popper.js/dist/umd/popper.min.js',
      'node_modules/bootstrap/dist/js/bootstrap.min.js',
      'node_modules/slick-carousel/slick/slick.min.js',
      srcFolder.concat('scripts/*'),
    ],
    dest: dstFolder.concat('scripts/'),
  },
  images: {
    src: [
      'node_modules/slick-carousel/slick/ajax-loader.gif',
      srcFolder.concat('images/*'),
    ],
    dest: dstFolder.concat('images/'),
  },
  fonts: {
    src: [
      'node_modules/@fortawesome/fontawesome-free/webfonts/*',
      srcFolder.concat('fonts/*'),
    ],
    dest: dstFolder.concat('fonts/'),
  },
}

function styles() {
  return gulp.src(paths.styles.src)
    .pipe(sass({
      includePaths: paths.styles.includes
    }))
    .pipe(cleanCSS())
    .pipe(rename({
      basename: 'main',
      suffix: '.min'
    }))
    .pipe(gulp.dest(paths.styles.dest));
}

function scripts() {
  return gulp.src(paths.scripts.src, { sourcemaps: true })
    .pipe(uglify())
    .pipe(gulp.dest(paths.scripts.dest));
}

function images() {
  return gulp.src(paths.images.src)
    .pipe(imagemin())
    .pipe(gulp.dest(paths.images.dest));
}

function fonts() {
  return gulp.src(paths.fonts.src)
    .pipe(gulp.dest(paths.fonts.dest));
}

const paths_sources = {
  php: ['./src/*.php'],
};

const paths_dest = {
  php: './',
};


/* HTML TASKS */

function minifyHTML() {
  return gulp.src(paths_sources.php)
    .pipe(rev())
    .pipe(htmlmin({
      collapseWhitespace: true,
      minifyJS: true,
      removeComments: true}))
    .pipe(gulp.dest(paths_dest.php));
}

/* execution ordering */

const html = gulp.series(minifyHTML);

function watchFiles() {
  gulp.watch(paths.styles.watchSrc, styles);
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.images.src, images);
  gulp.watch(paths.fonts.src, fonts);

  gulp.watch(paths_sources.php, html);
}

/* tasks definition */

gulp.task('build', gulp.series(styles, scripts, images, fonts, html));
gulp.task('default', gulp.series(styles, scripts, images, fonts, html, watchFiles));
