/**
 * @file
 *  Gulp task definitions for the project.
 *
 */
/* eslint-env node */
/* globals Promise:true */
'use strict';

var gulp = require('gulp-help')(require('gulp'));
var exec = require('child-process-promise').exec;
var phpcs = require('gulp-phpcs');
var eslint = require('gulp-eslint');
var phplint = require('gulp-phplint');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var minify = require('gulp-minify');
var mergeStream = require('merge-stream');
var behat = require('gulp-behat');
var gutil = require('gulp-util');
var csso = require('gulp-csso');
var imagemin = require('gulp-imagemin');

// Load in configuration.  You don't have to use this,
// but it makes it easier to update tasks in the future
// if paths aren't scattered in the gulpfile.
var config = require('./gulpconfig');


function mergeSources(arr) {
  var srcArr = [];
  for (var i = 0; i < arr.length; i++) {
    srcArr = srcArr.concat(arr[i].src);
  }
  return srcArr;
}

/**
 * Install tasks
 *
 * Add steps here to run during installation of the app.
 */
gulp.task('install', 'Run all install steps', ['install:composer', 'install:bower']);
gulp.task('install:composer', 'Run composer install', function (cb) {
  return exec('composer install');
});
gulp.task('install:bower', 'Run bower install', function () {
  var bower = __dirname + '/node_modules/.bin/bower';
  // Use --allow-root in case this needs to be built in a docker container
  // that forces root.
  return exec(bower + ' install --allow-root', {
    cwd: config.bowerJsonDirectory
  });
});


/**
 * Check tasks
 *
 * Add steps here to run during checking phase of the app.
 * Check steps should not require a database to function.
 */
gulp.task('check', 'Run static code analysis', ['check:phplint', 'check:phpcs', 'check:eslint']);
gulp.task('check:phplint', 'Lint PHP code', function () {
  return gulp.src(config.phpCheck)
    .pipe(phplint('', {notify: false, skipPassedFiles: true}))
    .pipe(phplint.reporter('fail'));
});
gulp.task('check:phpcs', 'Check Drupal code style', function () {
  return gulp.src(config.phpCheck)
    .pipe(phpcs({
      bin: 'vendor/bin/phpcs',
      standard: 'vendor/drupal/coder/coder_sniffer/Drupal'
    }))
    .pipe(phpcs.reporter('log'))
    .pipe(phpcs.reporter('fail'));
});
gulp.task('check:eslint', 'Check JS style', function () {
  return gulp
    .src(config.jsCheck)
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
});

/**
 * Test tasks
 *
 * Add steps here to run during the test phase.
 * Test steps may require a database and/or web server to function.
 */
gulp.task('test', 'Run all testing steps', ['test:behat', 'test:performance']);
gulp.task('test:behat', 'Run Behat tests', function () {
  return gulp.src('behat.yml')
    .pipe(behat(''));
});
gulp.task('test:performance', 'Run phantomas tests', function () {
  var promises = [];
  var promise;
  var cli;
  var name;
  var test;
  var url;

  function createSuccessReporter(name) {
    return function (result) {
      gutil.log('PASS: ' + name);
      gutil.log('-----------------');
      var data = JSON.parse(result.stdout);
      gutil.log('Requests: ' + data.metrics.requests);
      gutil.log('Time to http complete: ' + data.metrics.httpTrafficCompleted + 'ms');
      gutil.log('Size: ' + data.metrics.contentLength + 'b');
    };
  }
  function createFailReporter(name) {
    return function (result) {
      gutil.log('FAIL:' + name);
      gutil.log('-----------------');
      var data = JSON.parse(result.stdout);
      for (var i = 0; i < data.asserts.failedAsserts.length; i++) {
        var assertName = data.asserts.failedAsserts[i];
        gutil.log(assertName + ': ' + data.metrics[assertName]);
      }
      throw new gutil.PluginError('phantomas', {
        message: 'Performance tests failed for ' + name
      });
    };
  }

  for (var i = 0; i < config.perfTests.length; i++) {
    test = config.perfTests[i];
    name = test.name;
    url = config.baseUrl + test.url;
    cli = '';
    for (var prop in test) {
      if (test.hasOwnProperty(prop) && prop !== 'url' && prop !== 'name') {
        cli += ' --' + prop + '="' + test[prop] + '"';
      }
    }
    cli += ' --reporter=json ' + url;

    promise = exec('./node_modules/.bin/phantomas' + cli)
      .then(createSuccessReporter(name))
      .catch(createFailReporter(name));
    promises.push(promise);
  }

  // Return a chain of all the promises.
  return Promise.all(promises);
});

/**
 * Build tasks
 *
 * Add steps here to run during the app build process.
 */
gulp.task('build', 'Run all build steps.', ['build:scss', 'build:js', 'build:copy']);
gulp.task('build:watch', 'Run build steps and watch for changes', ['build:scss', 'build:js', 'build:copy'], function () {
  gulp.watch(mergeSources(config.js), ['build:js']);
  gulp.watch(mergeSources(config.scss), ['build:scss']);
  gulp.watch(mergeSources(config.copy), ['build:copy']);
});
gulp.task('build:scss', 'Build SCSS files', function () {
  var streams = mergeStream();
  config.scss.forEach(function (pack) {
    var stream = gulp
      .src(pack.src)
      .pipe(sourcemaps.init())
      .pipe(sass(pack.sassOptions).on('error', sass.logError))
      .pipe(autoprefixer(pack.prefix))
      .pipe(csso(pack.csso))
      .pipe(sourcemaps.write(pack.maps))
      .pipe(gulp.dest(pack.dest));
    streams.add(stream);
  });

  return streams.isEmpty() ? null : streams;
});
gulp.task('build:js', 'Build JS files', function () {
  var streams = mergeStream();
  config.js.forEach(function (pack) {
    var stream = gulp
      .src(pack.src)
      .pipe(sourcemaps.init());

    if (pack.concat !== false) {
      stream = stream.pipe(concat(pack.concat));
    }
    if (pack.min) {
      stream = stream.pipe(minify({
        ext: {
          src: '.js',
          min: '.min.js'
        }
      }));
    }
    stream = stream
      .pipe(sourcemaps.write(pack.maps))
      .pipe(gulp.dest(pack.dest));

    streams.add(stream);
  });
  return streams.isEmpty() ? null : streams;
});
gulp.task('build:copy', 'Copy source files', function () {
  var streams = mergeStream();
  config.copy.forEach(function (pack) {
    var stream = gulp
      .src(pack.src);

    if (pack.imagemin) {
      stream = stream.pipe(imagemin());
    }

    stream = stream.pipe(gulp.dest(pack.dest));
    streams.add(stream);
  });

  return streams.isEmpty() ? null : streams;
});
