
'use strict';

var del           = require('del');
var gulp          = require('gulp');
var livereload    = require('gulp-livereload');
var sourcemaps    = require('gulp-sourcemaps');
var sass          = require('gulp-sass');
var postcss       = require('gulp-postcss');
var autoprefixer  = require('autoprefixer');
var pixrem        = require('pixrem');
var csswring      = require('csswring');
var watch         = require('gulp-watch');
var notification  = require('node-notifier');
var util          = require('gulp-util');
var jade          = require('gulp-jade-php');

function handleErr(err)
{
    notification.notify({ title: 'Gulp Error', sound: true, message: err.message });
    util.log(util.colors.red('Gulp Error:'), err.message);
    this.emit('end');
}

gulp.task('default', [ 'clean' ], function ()
{
    gulp.start('watch');
});

gulp.task('clean', [ 'clean-css', 'clean-php' ]);

gulp.task('build', [ 'build-css', 'build-php' ]);

gulp.task('build-dev', [ 'build-dev-css', 'build-dev-php' ]);

gulp.task('watch', [ 'build-dev' ], function ()
{
    livereload.listen();
    watch([ './frontend/sass/*.scss' ],  { usePolling: true }, function () { gulp.start('build-dev-css'); });
    watch([ './frontend/jade/*.jade' ],  { usePolling: true }, function () { gulp.start('build-dev-php'); });
});

gulp.task('clean-css', function ()
{
    return del([ './css/*' ]);
});

gulp.task('clean-php', function ()
{
    return del([ './*.php' ]);
});

gulp.task('build-css', function ()
{
    return gulp.src('./frontend/sass/screen.scss')
        .pipe(sass())
        .pipe(postcss([ pixrem, autoprefixer, csswring ]))
        .pipe(gulp.dest('./css'));
});

gulp.task('build-php', [ 'clean-php' ], function ()
{
    return gulp.src('./frontend/jade/*.jade')
        .pipe(jade())
        .pipe(gulp.dest('./'));
});

gulp.task('build-dev-css', [ 'clean-css' ], function ()
{
    return gulp.src('./frontend/sass/screen.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'compressed' }))
        .on('error', handleErr)
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./css'))
        .pipe(livereload());
});

gulp.task('build-dev-php', [ 'clean-php' ], function ()
{
    return gulp.src('./frontend/jade/*.jade')
        .pipe(jade({ pretty: true }))
        .on('error', handleErr)
        .pipe(gulp.dest('./'))
        .pipe(livereload());
});
