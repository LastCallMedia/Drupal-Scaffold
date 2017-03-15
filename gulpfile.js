/**
 * @file
 *  Gulp task definitions for the project.
 *
 */
/* eslint-env node */

(function () {
  'use strict';

  // Load in CLI flags.
  var opts = require('yargs').argv;

  var gulp = require('gulp-help')(require('gulp'));
  var lcmGulpBuilder = require('./lcm-gulp-tasks');

  var config = require('./gulpconfig');
  lcmGulpBuilder(gulp, config, opts);

})();
