var gulp           = require('gulp');
var plumber        = require('gulp-plumber');
var watch          = require('gulp-watch');
var rename         = require('gulp-rename');
var sass           = require('gulp-sass');
var postcss        = require('gulp-postcss');
var autoprefixer   = require('autoprefixer');
var cssnano        = require('cssnano');
var uglify         = require('gulp-uglify');
var cmq            = require('gulp-combine-media-queries');

var dir = {
    src: {
        sass: './src/sass/**/*.scss',
        js: './src/js/**/*.js'
    },
    dist: {
        css: './css',
        js: './js'
    }
}

/**
 * sass
 */
gulp.task('sass', function() {
    gulp.src(dir.src.sass)
        .pipe(plumber({
            errorHandler: function(err) {
                console.log(err.messageFormatted);
                this.emit('end');
            }
        }))
        .pipe(sass())
        .pipe(postcss([
            autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
            })
        ]))
        .pipe(cmq({log: false}))
        .pipe(gulp.dest(dir.dist.css))
        .pipe(postcss([
            cssnano({
                'zindex': false
            })
        ]))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(dir.dist.css));
});

/**
 * js
 */
gulp.task('uglify', function () {
    gulp.src(dir.src.js)
        .pipe(plumber({
            errorHandler: function(err) {
                console.log(err.messageFormatted);
                this.emit('end');
            }
        }))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(dir.dist.js));
});

gulp.task('watch',['sass','uglify'],function() {
    watch(dir.src.sass, function(event) {
        gulp.start('sass');
    });
    watch(dir.src.js, function(event) {
        gulp.start('uglify');
    });
});