/**
 * @file
 *  Gulp task definitions for the project.
 *
 */
/* eslint-env node */
'use strict';

var gulp = require('gulp-help')(require('gulp'));
var exec = require('child-process-promise').exec;
var phpcs = require('gulp-phpcs');
var eslint = require('gulp-eslint');
var phplint = require('gulp-phplint');

/**
 * Install tasks
 *
 * Add steps here to run during installation of the app.
 */
gulp.task('install', 'Run all install steps', ['install:composer']);
gulp.task('install:composer', 'Run composer install', function (cb) {
  return exec('composer install');
});


/**
 * Check tasks
 *
 * Add steps here to run during checking/testing of the app.
 */
gulp.task('check', 'Run static code analysis checks', ['check:phpcs', 'check:eslint']);
gulp.task('check:phplint', 'Lint PHP code', function() {
  return gulp.src(['{modules,themes}/custom/**/*.{php,inc,module,theme,inc}'])
    .pipe(phplint())
    .pipe(phplint.reporter('fail'));
});
gulp.task('check:phpcs', 'Check Drupal code style', function () {
  return gulp.src(['{modules,themes}/custom/**/*.{php,inc,module,theme,inc}'])
    .pipe(phpcs({
      bin: 'vendor/bin/phpcs',
      standard: 'vendor/drupal/coder/coder_sniffer/Drupal'
    }))
    .pipe(phpcs.reporter('log'))
    .pipe(phpcs.reporter('fail'));
});

gulp.task('check:eslint', 'Check JS style', function () {
  return gulp.src(['gulpfile.js', 'modules/custom/**/*.js', 'themes/custom/**/*.js'])
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
});

/**
 * Build tasks
 *
 * Add steps here to run during the app build process.
 */
gulp.task('build', 'Run all build steps.');
