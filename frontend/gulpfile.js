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
  browserSync = require("browser-sync").create();


const config = require('./sites_config.json');
const siteConfig = config[(argv.site === undefined) ? 'base' : argv.site];


// General settings
const autoprefix = new LessAutoprefix({browsers: ['last 2 versions']});

function styles(done) {
  //console.log(siteConfig.path);
  console.log(fs.existsSync(siteConfig.path));
  console.log(siteConfig.path + 'less/*.less');

  return gulp.src(siteConfig.path + 'less/*.less')
    .pipe(sourcemaps.init())
    .pipe(less({
      plugins: [autoprefix],
      paths: [path.join(__dirname, 'less', 'includes', 'abstracts', 'plugins')]
    }).on('error', function(err){
      gutil.log(err);
      this.emit('end');
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(siteConfig.path + '/css'))
    .pipe(notify({ message: siteConfig.name + ' LESS task complete'}))
    .pipe(browserSync.stream());

  done();
}

function baseStyles(done) {
  //console.log(siteConfig.path);
  console.log(fs.existsSync(siteConfig.path));
  console.log('less/*.less');

  return gulp.src('less/*.less')
    .pipe(sourcemaps.init())
    .pipe(less({
      plugins: [autoprefix],
      paths: [path.join(__dirname, 'less', 'includes', 'abstracts', 'plugins')]
    }).on('error', function(err){
      gutil.log(err);
      this.emit('end');
    }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('/css'))
    .pipe(notify({ message: siteConfig.name + ' LESS task complete'}))
    .pipe(browserSync.stream());

  done();
}


function prodAll(done) {

  for (var obj in config) {
    const sitePath = config[obj].path;
    const siteName = config[obj].name;

    const pathExists = fs.existsSync(sitePath);

    try {

      if (pathExists) {

        const siteProd = function (cb) {
          console.log(sitePath + 'less/*.less')
          gulp.src(sitePath + 'less/*.less')
            .pipe(less({
              plugins: [autoprefix],
              paths: [path.join(__dirname, 'less', 'includes', 'abstracts', 'plugins')]
            }).on('error', function(err){
              gutil.log(err);
              this.emit('end');
            }))
            .pipe(gulp.dest(sitePath + 'css'))
            .pipe(notify({ message: siteName + ' LESS task complete'}))

          cb();
        };

        return siteProd();
      } else {
        console.log('Site ' + name + ' not found');
      }
    }
    catch (error) {
      done();
    }
  }
  done();
}


// Watch files
function watch() {

  browserSync.init({
    proxy: siteConfig.proxy
  });

  gulp.watch('less/**/*.less', gulp.series(baseStyles));
  gulp.watch(siteConfig.path + 'less/**/*.less', gulp.series(styles));
}


exports.styles = styles;
exports.default = watch;
exports.all = prodAll;
