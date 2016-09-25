var gulp = require('gulp'),
    gutil = require('gulp-util'),
    clean = require('gulp-clean'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    concat = require('gulp-concat'),
    cache = require('gulp-cache'),
    sass = require('gulp-sass'),
    minifyCss = require('gulp-minify-css'),
    rename = require('gulp-rename'),
    argv = require('yargs').argv,
    ngAnnotate = require('gulp-ng-annotate'),
    karma = require('gulp-karma'),
    es = require('event-stream'),
    sq = require('streamqueue');

var paths = {
    sassDir: [
        './public/sass/**/*.scss'
    ],
    sass: [
        './public/sass/application.scss'
    ],
    css: [
        './public/css/**/*.css'
    ],
    js: [
        './public/js/vendor/angularjs/*.min.js',
        './public/js/vendor/bootstrap/*.js',
        './public/js/vendor/codemirror/*.js',
        './public/js/vendor/jquery/*.js',
        './public/js/vendor/*.js',
        './public/js/ie.js',
        './public/js/ios.js',
        './public/js/app.js',
        './public/js/run.js',
        './public/js/constants/**/*.js',
        './public/js/constants.js',
        './public/js/services/**/*.js',
        './public/js/controllers/**/*.js',
        './public/js/directives/**/*.js',
        './public/js/filters/**/*.js',
        './public/js/lib/*.js'
    ],
    img: [
        './public/img/*',
        './public/img/**/*'
    ],
    fonts: [
        './public/fonts/**/*.*'
    ],
    tests: [
        './public/js/vendor/jquery/jquery.min.js',
        './public/js/vendor/angular/angular.min.js',
        './public/js/vendor/bootstrap/bootstrap.min.js',
        './public/js/vendor/angular-bootstrap/ui-bootstrap.min.js',
        './public/js/vendor/ng-table/dist/ng-table.min.js',
        './public/js/vendor/angular-resource/angular-resource.min.js',
        './public/js/vendor/angular-sanitize/angular-sanitize.min.js',
        './public/js/vendor/angular-mocks/angular-mocks.js',
        './public/js/tests/**/*.js',
        './public/js/templates/**/*.html'
    ]
};

gulp.task('css', ['clean-css'], function () {
    var vendorFiles = gulp.src(paths.css);
    var appFiles = gulp.src(paths.sass)
        .pipe(sass({style: 'compressed'}).on('error', gutil.log));

    return es.concat(vendorFiles, appFiles)
        .pipe(concat('app.css'))
        .pipe(gulp.dest('./public/dist/css/'))
        .pipe(minifyCss({keepSpecialComments: 1}))
        .pipe(rename({extname: '.min.css'}))
        .pipe(gulp.dest('./public/dist/css/'))
        .on('error', gutil.log);
});

gulp.task('js', function () {
    return gulp.src(paths.js)
        .pipe(concat('app.min.js'))
        .pipe(ngAnnotate())
        .pipe(gulp.dest('./public/dist/js'))
        .on('error', gutil.log);
});

gulp.task('jsCopy', function () {
    return gulp.src(paths.jsCopy)
        .pipe(gulp.dest('./public/dist/js'))
        .on('error', gutil.log);
});

gulp.task('img', ['clean-img'], function () {
    return gulp.src(paths.img)
        .pipe(gulp.dest('./public/dist/img'))
        .on('error', gutil.log);
});

gulp.task('fonts', ['clean-fonts'], function () {
    return gulp.src(paths.fonts)
        .pipe(gulp.dest('./public/dist/fonts/'))
        .on('error', gutil.log);
});

gulp.task('clean-img', function () {
    return gulp.src('./public/dist/img', {read: false})
        .pipe(clean());
});

gulp.task('clean-fonts', function () {
    return gulp.src('./public/dist/fonts', {read: false})
        .pipe(clean());
});

gulp.task('clean-js', function () {
    return gulp.src('./public/dist/js', {read: false})
        .pipe(clean());
});

gulp.task('clean-css', function () {
    return gulp.src('./public/dist/css', {read: false})
        .pipe(clean());
});

gulp.task('clean', function () {
    return gulp.src('./public/dist/', {read: false})
        .pipe(clean({force: true}));
});

gulp.task('test', function () {
    var testFiles = gulp.src(paths.tests);
    var appFiles = gulp.src(paths.js);

    var stream = sq({ objectMode: true });
    stream.queue(testFiles);
    stream.queue(appFiles);
    return stream.done()
        .pipe(karma({
            configFile: './karma.conf.js',
            action: 'run'
        }))
        .on('error', function (err) {
            throw err;
        });
});

gulp.task('default', ['build']);

gulp.task('build', ['css', 'js', 'img', 'fonts']);

gulp.task('watch', ['build'], function () {
    gulp.watch(paths.sassDir, ['css']);
    gulp.watch(paths.img, ['img']);
    gulp.watch(paths.js, ['js']);
    // gulp.watch(paths.partials, ['partials']);
    // gulp.watch(paths.templates, ['templates']);
});
