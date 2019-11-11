/**
 * @file
 *  Gulp task definitions for the project.
 *
 */
/* eslint-env node */
var gulp = require('gulp');
var Registry = require('lastcall-gulp-drupal-tasks');
var config = require('./gulpconfig');

// Register common tasks.  Use `gulp --tasks` to get a current list.
gulp.registry(new Registry(config));
// Set the default task.
gulp.task('default', gulp.series('build:watch'));
