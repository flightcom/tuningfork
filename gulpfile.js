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
    partials: [
        './public/js/partials/**/*.html'
    ],
    templates: [
        './public/js/templates/**/*.html',
        './public/js/vendor/angular-utils-pagination/dirPagination.tpl.html'
    ],
    tinymce: [
        './public/js/vendor/tinymce/**/*.*'
    ],
    sassDir: [
        './public/sass/**/*.scss'
    ],
    sassSplashDir: [
        './public/sass-splash/**/*.scss'
    ],
    sassSignupDir: [
        './public/sass-signup/**/*.scss'
    ],
    docs: [
        './public/docs/**/*.*'
    ],
    sass: [
        './public/sass/application.scss'
    ],
    sassSplash: [
        './public/sass-splash/main.scss'
    ],
    sassSignup: [
        './public/sass-signup/main.scss'
    ],
    css: [
        './public/css/**/*.css',
        './public/js/vendor/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.css',
        './public/js/vendor/ng-tags-input/ng-tags-input.min.css',
        './public/js/vendor/angular-busy/angular-busy.css',
        './public/js/vendor/angular-tour/dist/angular-tour.css',
        './public/css/tinymce/tinymce.css',
        './public/css/vendor/datepicker.css'
    ],
    tinymceTheme: [
        './public/js/vendor/tinymce/themes/modern/theme.min.js'
    ],
    js: [
        './public/js/jquery-ui.min.js',
        './public/js/vendor/tinymce/tinymce.min.js',
        './public/js/vendor/underscore/underscore-min.js',
        './public/js/vendor/ng-file-upload/angular-file-upload-shim.min.js',
        './public/js/vendor/ng-file-upload/angular-file-upload.min.js',
        './public/js/vendor/angular-busy/angular-busy.js',
        './public/js/vendor/angular-touch/angular-touch.min.js',
        './public/js/vendor/angular-loading-bar/build/loading-bar.min.js',
        './public/js/vendor/angular-bootstrap-lightbox/dist/angular-bootstrap-lightbox.min.js',
        './public/js/vendor/ng-lodash/build/ng-lodash.js',
        './public/js/vendor/angular-osd-form/angular-osd-form.min.js',
        './public/js/vendor/angular-utils-pagination/dirPagination.js',
        './public/js/vendor/ng-tags-input/ng-tags-input.min.js',
        './public/js/vendor/angular-file-saver/dist/angular-file-saver.bundle.min.js',
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
    jsCopySplash: [
        './public/js-splash/jquery-1.11.2.min.js',
        './public/js-splash/bootstrap.min.js',
        './public/js-splash/jcf.js',
        './public/js-splash/**/*.js'
    ],
    jsCopySignup: [
        './public/js-splash/jquery-1.11.2.min.js',
        './public/js-splash/jquery.main.js'
    ],
    mediaCopy: [
        './public/media/*'
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
        'public/js/templates/**/*.html'
    ]
};

gulp.task('default', ['build']);

gulp.task('build', ['css', 'cssSplash', 'cssSignup', 'js', 'jsCopySplash', 'jsCopySignup', 'img', 'mediaCopy', 'fonts', 'partials', 'templates', 'tinymce', 'tinymceTheme', 'docs']);

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

gulp.task('cssSplash', function () {
    var appFiles = gulp.src(paths.sassSplash)
        .pipe(sass({style: 'compressed'}).on('error', gutil.log));

    return appFiles
        .pipe(concat('app-splash.css'))
        .pipe(gulp.dest('./public/dist/css/'))
        .pipe(minifyCss({keepSpecialComments: 1}))
        .pipe(rename({extname: '.min.css'}))
        .pipe(gulp.dest('./public/dist/css/'))
        .on('error', gutil.log);
});

gulp.task('cssSignup', function () {
    var appFiles = gulp.src(paths.sassSignup)
        .pipe(sass({style: 'compressed'}).on('error', gutil.log));

    return appFiles
        .pipe(concat('app-signup.css'))
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

gulp.task('jsCopySplash', function () {
    return gulp.src(paths.jsCopySplash)
        .pipe(concat('app-splash.js'))
        .pipe(gulp.dest('./public/dist/js-splash'))
        .on('error', gutil.log);
});

gulp.task('jsCopySignup', function () {
    return gulp.src(paths.jsCopySplash)
        .pipe(concat('app-signup.js'))
        .pipe(gulp.dest('./public/dist/js-signup'))
        .on('error', gutil.log);
});

gulp.task('mediaCopy', function () {
    return gulp.src(paths.mediaCopy)
        .pipe(gulp.dest('./public/dist/media'))
        .on('error', gutil.log);
});

gulp.task('docs', function () {
    return gulp.src(paths.docs)
        .pipe(gulp.dest('./public/dist/docs'))
        .on('error', gutil.log);
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

gulp.task('img', ['clean-img'], function () {
    return gulp.src(paths.img)
        .pipe(gulp.dest('./public/dist/img'))
        .on('error', gutil.log);
});

gulp.task('partials', ['clean-partials'], function () {
    return gulp.src(paths.partials)
        .pipe(gulp.dest('./public/dist/partials'))
        .on('error', gutil.log);
});

gulp.task('templates', ['clean-template'], function () {
    return gulp.src(paths.templates)
        .pipe(gulp.dest('./public/dist/js/templates'))
        .on('error', gutil.log);
});

gulp.task('fonts', ['clean-fonts'], function () {
    return gulp.src(paths.fonts)
        .pipe(gulp.dest('./public/dist/fonts/'))
        .on('error', gutil.log);
});

gulp.task('clean-partials', function () {
    return gulp.src('./public/dist/partials', {read: false})
        .pipe(clean());
});

gulp.task('clean-template', function () {
    return gulp.src('./public/dist/js/templates', {read: false})
        .pipe(clean());
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

gulp.task('watch', ['build'], function () {
    gulp.watch(paths.sassDir, ['css']);
    gulp.watch(paths.sassSplashDir, ['cssSplash']);
    gulp.watch(paths.sassSignupDir, ['cssSignup']);
    gulp.watch(paths.img, ['img']);
    gulp.watch(paths.js, ['js']);
    gulp.watch(paths.jsCopySplash, ['jsCopySplash']);
    gulp.watch(paths.jsCopySignup, ['jsCopySignup']);
    gulp.watch(paths.partials, ['partials']);
    gulp.watch(paths.templates, ['templates']);
});
