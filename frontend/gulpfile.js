'use strict';

const gulp = require('gulp'),
  less = require('gulp-less'),
  path = require('path'),
  sourcemaps = require('gulp-sourcemaps'),
  gutil = require('gulp-util'),
  notify = require('gulp-notify'),
  LessAutoprefix = require('less-plugin-autoprefix'),
  fs = require('node-fs'),
  argv = require('yargs').argv,
  concat = require('gulp-concat-util'),
  minify = require("gulp-minify"),
  plumber = require("gulp-plumber"),
  kss = require('kss'),
  browserSync = require("browser-sync").create();


const config = require('./sites_config.json');
const siteConfig = config[(argv.site === undefined) ? 'base' : argv.site];


// General settings
const autoprefix = new LessAutoprefix({browsers: ['last 2 versions']});

function styles() {
  //console.log(siteConfig.path);
  console.log(fs.existsSync(siteConfig.path));
  console.log(siteConfig.path + 'less/*.less');

  return gulp.src(siteConfig.path + 'less/*.less')
    .pipe(sourcemaps.init())
    .pipe(less({
      plugins: [autoprefix],
      paths: [path.join(__dirname, 'includes', 'abstracts', 'plugins', 'components')]
    }).on('error', function (err) {
      gutil.log(err);
      this.emit('end');
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(siteConfig.dest))
    .pipe(notify({message: siteConfig.name + ' LESS task complete'}))
    .pipe(browserSync.stream());

  done();
}


function prod() {
  //console.log(siteConfig.path);
  console.log(fs.existsSync(siteConfig.path));
  console.log(siteConfig.path + 'less/*.less');

  return gulp.src(siteConfig.path + 'less/*.less')
    .pipe(less({
      plugins: [autoprefix],
      paths: [path.join(__dirname, 'includes', 'abstracts', 'plugins', 'components')]
    }).on('error', function (err) {
      gutil.log(err);
      this.emit('end');
    }))
    .pipe(gulp.dest(siteConfig.dest))
    .pipe(notify({message: siteConfig.name + ' LESS task complete'}));

  done();
}

function baseStyles(done) {
  return gulp.src('../less/*.less')
    .pipe(sourcemaps.init())
    .pipe(less({
      plugins: [autoprefix],
      paths: [path.join(__dirname, 'includes', 'abstracts', 'plugins', 'components')]
    }).on('error', function (err) {
      gutil.log(err);
      this.emit('end');
      done();
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('../'))
    .pipe(notify({message: siteConfig.name + ' LESS task complete'}))
    .pipe(browserSync.stream());

  done();
}

// Javascript files

function baseJs(done) {
  //del(['../js/gc-main-min.js'], {force: true});

  gulp.src('../js/components/{,*/}*.js')
    .pipe(concat('gc-main.js'))
    .pipe(sourcemaps.init())
    .pipe(concat.header('(function ($, document, window) { \n'))
    .pipe(concat.footer('})(jQuery, document, window);'))
    .pipe(plumber())
    .pipe(minify({
      ext:{
        src:'-debug.js',
        min:'-min.js'
      },
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('../js'))
    .pipe(notify({message: 'Theme JS Task complete'}))
    .pipe(browserSync.stream());

  done();
}


function prodAll(done) {

  for (var obj in config) {
    var sitePath = config[obj].path;
    var siteName = config[obj].name;

    var pathExists = fs.existsSync(sitePath);

    if (pathExists && config.hasOwnProperty(obj)) {
      try {

        var siteProd = function (cb) {
          console.log(sitePath + 'less/*.less')
          gulp.src(sitePath + 'less/*.less').pipe(less({
            plugins: [autoprefix],
            paths: [path.join(__dirname, 'less', 'includes', 'abstracts', 'plugins')]
          }).on('error', function (err) {
            gutil.log(err);
            this.emit('end');
          }))
            .pipe(gulp.dest(sitePath + 'css'))
            .pipe(notify({message: siteName + ' LESS task complete'}))

          cb();
        };

        return siteProd();
      }
      catch (error) {
        done();
      }
    } else {
      console.log('Site ' + name + ' not found');
    }
    done();

  }
}


/*
 * StyleGuide
 */

const kssConfig = require('./styleguide/kss-config.json');

function styleGuide(done){
  return kss(kssConfig);

  done();
}


// Watch Styleguide styles
function sgStyles(done) {

  return gulp.src('styleguide/less/*.less')
    .pipe(less({
      plugins: [autoprefix],
      paths: [path.join(__dirname, 'less')]
    }).on('error', function (err) {
      gutil.log(err);
      this.emit('end');
      done();
    }))
    .pipe(gulp.dest('./styleguide/css'))
    .pipe(notify({message: siteConfig.name + ' LESS task complete'}))
    .pipe(browserSync.stream());

  done();
}


// Watch files
function watch() {

  browserSync.init({
    proxy: siteConfig.proxy
  });

  if (argv.site) {
    console.log('ja hoor');
    gulp.watch('../less/**/*.less', gulp.series(baseStyles, styles));
  }

  gulp.watch('../js/components/*.js', gulp.series(baseJs));
  gulp.watch(siteConfig.path + 'less/**/*.less', gulp.series(styles));

  // Styleguide
  gulp.watch('styleguide/elements/**', gulp.series(styleGuide));
  gulp.watch('styleguide/less/**', gulp.series(sgStyles));
}


exports.styles = styles;
exports.prod = prod;
exports.baseJs = baseJs;
exports.default = watch;
exports.all = prodAll;
exports.styleguide = gulp.series(sgStyles, styleGuide);
