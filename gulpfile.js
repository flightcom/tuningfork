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
    sq = require('streamqueue'),
    spawn = require('child_process').spawn;

var paths = {
    sassDir: [
        './public/sass/**/*.scss'
    ],
    sass: [
        './public/sass/application.scss'
    ],
    cssDir: [
        './public/css/**/*.css',
        './node_modules/bootstrap-social/bootstrap-social.css',
        './node_modules/ng-table/bundles/ng-table.min.css',
        './node_modules/angular-busy/dist/angular-busy.min.css',
        './node_modules/ng-tags-input/build/ng-tags-input.bootstrap.min.css'
    ],
    js: [
        './node_modules/angular/angular.min.js',
        './node_modules/angular-route/angular-route.min.js',
        './node_modules/angular-resource/angular-resource.min.js',
        './node_modules/angular-sanitize/angular-sanitize.min.js',
        // './node_modules/jquery/dist/jquery.min.js',
        // './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './public/js/vendor/ngmap/build/scripts/ng-map.min.js',
        './node_modules/angular-busy/dist/angular-busy.min.js',
        './node_modules/angular-osd-form/angular-osd-form.min.js',
        // Required by angular-osd-form
        './node_modules/ng-lodash/build/ng-lodash.min.js',
        './node_modules/angular-ui-bootstrap/dist/ui-bootstrap.js',
        './node_modules/ng-table/bundles/ng-table.min.js',
        './node_modules/ng-tags-input/build/ng-tags-input.min.js',
        './node_modules/ngstorage/ngStorage.min.js',
        './node_modules/tinymce/tinymce.min.js',
        './node_modules/tinymce/themes/modern/theme.min.js',
        './public/js/vendor/angular-parallax/scripts/angular-parallax.js',
        './node_modules/underscore/underscore-min.js',
        // './public/js/vendor/codemirror/*.js',
        // './public/js/vendor/*.js',
        './public/js/ie.js',
        './public/js/ios.js',
        './public/js/app.js',
        './public/js/run.js',
        // './public/js/app-tomove.js',
        // './public/js/app-admin.js',
        './public/js/constants/**/*.js',
        './public/js/routes/**/*.js',
        './public/js/configs/**/*.js',
        './public/js/services/**/*.js',
        './public/js/controllers/**/*.js',
        './public/js/directives/**/*.js',
        './public/js/filters/**/*.js',
        // './public/js/fb.js',
        // './public/js/utils.js',
        // './public/js/public.js',
        // './public/js/admin.js',
    ],
    img: [
        './public/img/*',
        './public/img/**/*'
    ],
    fonts: [
        './public/fonts/**/*.*'
    ],
    tinymce: [
        './node_modules/tinymce/**/*.*'
    ],
    tests: [
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/angular/angular.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/ng-table/bundles/ng-table.min.js',
        './node_modules/angular-resource/angular-resource.min.js',
        './node_modules/angular-sanitize/angular-sanitize.min.js',
        './node_modules/angular-mocks/angular-mocks.js',
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
    gulp.watch([paths.sassDir, paths.cssDir], ['css']);
    gulp.watch(paths.img, ['img']);
    gulp.watch(paths.js, ['js']);
    // gulp.watch(paths.partials, ['partials']);
    // gulp.watch(paths.templates, ['templates']);
});

gulp.task('auto-reload', function() {
  var p;

  gulp.watch('gulpfile.js', spawnChildren);
  spawnChildren();

  function spawnChildren(e) {
    // kill previous spawned process

    if(p) { p.kill(); }
    // `spawn` a child `gulp` process linked to the parent `stdio`
    p = spawn('gulp', [argv.task], {stdio: 'inherit'});
  }
});
