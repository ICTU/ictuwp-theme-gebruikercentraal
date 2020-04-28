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
    svgSprite = require('gulp-svg-sprite'),
    svgmin = require('gulp-svgmin'),
    browserSync = require("browser-sync").create();


const config = require('./sites_config.json');
const siteConfig = config[(argv.site === undefined) ? 'base' : argv.site];


// General settings
const autoprefix = new LessAutoprefix({browsers: ['last 2 versions']});

function styles() {

    console.log('styles path is dus: ' + siteConfig.path);

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
        .pipe(gulp.dest('../css/'))
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
            ext: {
                src: '-debug.js',
                min: '-min.js'
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
            } catch (error) {
                done();
            }
        } else {
            console.log('Site ' + siteName + ' not found');
        }
        done();

    }
}

/*
 * StyleGuide
 */

const kssConfig = require('./styleguide/kss-config.json');

function styleGuide(done) {
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

/*
 * SVG Sprites
 * Make sprites for each directory in images/svg
 */

// Basic configuration example
const svgSpriteConfig = {
    log: 'info',
    shape: {
        dimension: {
            maxWidth: 100,
            maxHeight: 100
        }
    },
    mode: {
        defs: true,
    }
};

function getFolders(dir) {
    return fs.readdirSync(dir)
        .filter(function (file) {
            return fs.statSync(path.join(dir, file)).isDirectory();
        });
}

function makeSprites(done) {
    var folders = getFolders('../images/svg/');

    if (folders) {
        console.log(folders);

        folders.map(function (folder) {

            return gulp.src('../images/svg/' + folder + '/*.svg')
                .pipe(svgmin())
                .pipe(svgSprite(svgSpriteConfig)).on('error', function (error) {
                    gutil.log(gutil.colors.red(error));
                })
                .pipe(gulp.dest('../images/svg/' + folder))
                .pipe(notify({message: folder + ' SVG Sprite generated'}));
        });

        done();

    } else {
        console.log(folders + 'not found');
        done();
    }

}


// Watch files
function watch() {

    console.log(' ** Sitename: ' + siteConfig.name + ', Plugintype: ' + siteConfig.type + ' ** ');

    browserSync.init({
        proxy: siteConfig.proxy,

        ghostMode: {
            clicks: true,
            forms: true,
            scroll: false
        }

    });

    //Base Styles

    // Javascripts
    gulp.watch('../js/components/*.js', gulp.series(baseJs));

    // Styleguide
    gulp.watch('styleguide/elements/**', gulp.series(styleGuide));
    gulp.watch('styleguide/less/**', gulp.series(sgStyles));

    switch (siteConfig.type) {
        case 'plugin':

            // watch any php
            gulp.watch(siteConfig.pluginsource + '*.php', gulp.series(plugincollect, plugincopyfolder));

            // watch any translation files: trigger this if a .po or *.pot file changes
            gulp.watch(siteConfig.path + 'languages/*.po', gulp.series(plugintranslations, plugincollect, plugincopyfolder));
            gulp.watch(siteConfig.path + 'languages/*.pot', gulp.series(plugintranslations, plugincollect, plugincopyfolder));

            // Watch less
            gulp.watch('../less/**/*.less', gulp.series(baseStyles, styles));
            gulp.watch(siteConfig.path + 'less/**/*.less', gulp.series(styles));

            break;

        case 'theme':
            gulp.watch('../less/**/*.less', gulp.series(baseStyles));
            break;
    }
}

//--------------------------------------------------------

function plugincollect(done) {

    console.log('plugincollect');

    // to do:
    // in sites_config een array aanmaken waarin
    // diverse bestanden zitten die hier in de plugin folder
    // onderhouden worden, maar nodig zijn in de plugin folder
    // zoiets als '../plugincomponenten/bestand1.dinges'
    // en dit bestand kopieren naar '[plugin folder]/[bestemming]'
    //

//    copyarray.map(function (currentfile) {
//
//		gulp.src( currentfile )
//			.pipe(gulp.dest( targetfolder ));
//
//    });

    done();

}

//--------------------------------------------------------

function plugintranslations(done) {

    // to do:
    // watch zodanig inrichten dat de bestanden in [plugin]/languages
    // naar de juiste plek worden gekopieerd.
    // voorbeeldstructuuur:
    // [plugin]
    // ├── languages/
    // │   ├── ictuwp-plugin-conference.pot
    // │   ├── ictuwp-plugin-conference-nl_NL.mo
    // │   ├── ictuwp-plugin-conference-nl_NL.po
    // │   ├── ictuwp-plugin-conference-en_US.mo
    // │   ├── ictuwp-plugin-conference-en_US.po
    // │   ├── ictuwp-plugin-conference-en_GB.mo
    // │   └── ictuwp-plugin-conference-en_GB.po
    //
    // al deze bestanden moeten worden gekopieerd behalve 1: het *.pot bestand
    // Ze moeten worden gekopieerd naar ]webroot]/wp-content/languages/themes
    // en de bestandsnaam moet overeenstemmen met de vertaalsleutel in de plugin

    console.log('plugintranslations');

    done();

}

//--------------------------------------------------------

function plugincopyfolder(done) {

    gulp.src([siteConfig.pluginsource + '/*']).pipe(gulp.dest(siteConfig.plugintarget));

    console.log("Kopieer de plugin naar de juiste folder: from: " + siteConfig.pluginsource + " to: " + siteConfig.plugintarget);

    done();

}

//--------------------------------------------------------

function pluginstyle(done) {

    // dit is voor nu nog een aparte functie omdat de folderstructuur van
    // de less bestanden per plugin verschilt
    // ik heb de path.join gekopieerd uit 'styles()', maar ik
    // snap 'm nog niet zo goed. Wat doet het en waarom?


    /*
    Gaan we nog bespreken, is nu dubbel ;).

      return gulp.src(siteConfig.csssource + '*.less')
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
          .pipe(gulp.dest( siteConfig.cssdest ) )
          .pipe(notify({message: 'pluginstyle: ' + siteConfig.name + ' LESS task complete'}))
          .pipe(browserSync.stream());

      done();*/

}


//--------------------------------------------------------


exports.styles = styles;
exports.prod = prod;
exports.baseJs = baseJs;
exports.default = watch;
exports.all = prodAll;
exports.sprites = makeSprites;
exports.styleguide = gulp.series(sgStyles, styleGuide);


// to do: productie commando voor plugin ontwikkeling