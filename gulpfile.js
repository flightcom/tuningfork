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
    cssDir: [
        './public/css/**/*.css',
        './public/js/vendor/bootstrap-social/bootstrap-social.css'
    ],
    js: [
        './public/js/vendor/angular/angular.min.js',
        './public/js/vendor/ngmap/build/scripts/ng-map.min.js',
        './public/js/vendor/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.min.js',
        './public/js/vendor/angular-bootstrap/ui-bootstrap.min.js',
        './public/js/vendor/angular-busy/angular-busy.js',
        './public/js/vendor/angular-file-saver/dist/angular-file-saver.bundle.min.js',
        './public/js/vendor/angular-loading-bar/build/loading-bar.min.js',
        './public/js/vendor/angular-osd-form/angular-osd-form.min.js',
        './public/js/vendor/angular-resource/angular-resource.min.js',
        './public/js/vendor/angular-route/angular-route.min.js',
        './public/js/vendor/angular-sanitize/angular-sanitize.min.js',
        './public/js/vendor/angular-touch/angular-touch.min.js',
        './public/js/vendor/angular-ui-sortable/sortable.min.js',
        './public/js/vendor/angular-ui-tinymce/dist/tinymce.min.js',
        './public/js/vendor/angular-utils-pagination/dirPagination.js',
        './public/js/vendor/ng-file-upload/angular-file-upload-shim.min.js',
        './public/js/vendor/ng-file-upload/angular-file-upload.min.js',
        './public/js/vendor/ng-lodash/build/ng-lodash.js',
        './public/js/vendor/ng-table/dist/ng-table.min.js',
        './public/js/vendor/ng-tags-input/ng-tags-input.min.js',
        './public/js/vendor/ngstorage/ngStorage.js',
        './public/js/vendor/tinymce/tinymce.min.js',
        './public/js/vendor/tinymce/themes/modern/theme.min.js',
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/ng-parallax/src/ngParallax.min.js',
        './public/js/vendor/bootstrap/bootstrap.min.js',
        './public/js/vendor/bootstrap/bootstrap-typeahead.min.js',
        './public/js/vendor/underscore/underscore-min.js',
        './public/js/vendor/codemirror/*.js',
        './public/js/vendor/*.js',
        './public/js/ie.js',
        './public/js/ios.js',
        './public/js/app.js',
        './public/js/run.js',
        './public/js/app-tomove.js',
        './public/js/app-admin.js',
        './public/js/constants/**/*.js',
        './public/js/constants.js',
        './public/js/configs/**/*.js',
        './public/js/services/**/*.js',
        './public/js/controllers/**/*.js',
        './public/js/directives/**/*.js',
        './public/js/filters/**/*.js',
        './public/js/lib/*.js',
        './public/js/fb.js',
        './public/js/utils.js',
        './public/js/public.js',
        './public/js/admin.js',
    ],
    img: [
        './public/img/*',
        './public/img/**/*'
    ],
    fonts: [
        './public/fonts/**/*.*'
    ],
    tinymce: [
        './public/js/vendor/tinymce/**/*.*'
    ],
    tinymceTheme: [
        './public/js/vendor/tinymce/themes/modern/theme.min.js'
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
    var vendorFiles = gulp.src(paths.cssDir);
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

gulp.task('js', ['clean-js'], function () {
    return gulp.src(paths.js)
        .pipe(concat('app.min.js'))
        .pipe(ngAnnotate())
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

gulp.task('tinymce', function () {
    return gulp.src(paths.tinymce)
        .pipe(gulp.dest('./public/dist/js/vendor/tinymce'))
        .on('error', gutil.log);
});

gulp.task('tinymceTheme', function () {
    return gulp.src(paths.tinymceTheme)
        .pipe(rename('theme.js'))
        .pipe(gulp.dest('./public/dist/js/vendor/tinymce/themes/modern'))
        .on('error', gutil.log);
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

gulp.slurped = false;

gulp.task('watch', ['build'], function () {
    if(!gulp.slurped){ // step 2
        gulp.watch("gulpfile.js", ["default"]);
        gulp.slurped = true; // step 3
    }
    gulp.watch([paths.sassDir, paths.cssDir], ['css']);
    gulp.watch(paths.img, ['img']);
    gulp.watch(paths.js, ['js']);
    // gulp.watch(paths.partials, ['partials']);
    // gulp.watch(paths.templates, ['templates']);
});
