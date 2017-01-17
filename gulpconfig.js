/* eslint-env node */

(function () {
  'use strict';

  var ip = require('ip');

  // The folder the web accessible code lives in.
  // @docroot
  var docroot = './web';

  var options = {
    bowerJsonDirectory: './',
    baseUrl: 'http://' + ip.address() + ':8888',
    // Packages of SCSS that will be compiled.
    scss: [
      {
        src: docroot + '/themes/custom/scaffold/scss/**/*.scss',
        maps: '../maps',
        prefix: {browsers: 'last 2 versions', cascade: false},
        dest: docroot + '/themes/custom/scaffold/dist/css',
        // Pass options to node-sass.
        sassOptions: {
          // Include paths to resolve automatically.
          includePaths: ['./bower_components/']
        }
      }
    ],
    // Packages of javascript that will be compiled.
    js: [
      {
        src: [docroot + '/themes/custom/scaffold/js/**/*.js'],
        concat: false,
        min: true,
        maps: '../maps',
        dest: docroot + '/themes/custom/scaffold/dist/js'
      },
      {
        src: [
          './bower_components/what-input/what-input.js',
          './bower_components/foundation-sites/dist/js/foundation.js'
        ],
        concat: 'libs.js',
        min: true,
        maps: '../maps',
        dest: docroot + '/themes/custom/scaffold/dist/js'
      }
    ],
    // Packages of files that will be copied.
    // Files can optionally be passed through imagemin.
    copy: [
      {
        src: docroot + '/themes/custom/scaffold/images',
        imagemin: true,
        dest: docroot + '/themes/custom/scaffold/dist/images'
      }
    ],
    // Patterns for PHP files to lint and check.
    phpCheck: [docroot + '/{modules,themes}/custom/**/*.{php,inc,module,theme,inc,install}'],
    // Patterns for JS files to lint and check.
    jsCheck: [
      'gulpfile.js',
      'gulpconfig.js',
      'backstop/{scripts,}/*.js',
      docroot + '/{modules,themes}/custom/**/*.js',
      '!' + docroot + '/{modules,themes}/custom/**/bower_components/**',
      '!' + docroot + '/{modules,themes}/custom/**/node_modules/**',
      '!' + docroot + '/{modules,themes}/custom/**/dist/**'
    ],
    perfTests: [
      {
        name: 'homepage',
        url: '/',
        screenshot: './artifacts/homepage.jpg',
        har: './artifacts/homepage.har'
        // Add assertions as needed:
        // "assert-requests": 5,
        // These options are converted into phantomas CLI options.
        // @see https://github.com/macbre/phantomas
      }
    ]
  };

  module.exports = options;
})();
