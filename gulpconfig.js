/* eslint-env node */
'use strict';

var options = {
  bowerJsonDirectory: './',
  baseUrl: 'http://127.0.0.1:8888',
  // Packages of SCSS that will be compiled.
  scss: [
    {
      src: './themes/custom/scaffold/scss/**/*.scss',
      maps: '../maps',
      prefix: {browsers: 'last 2 versions', cascade: false},
      dest: './themes/custom/scaffold/dist/css',
      // Pass options to node-sass.
      sassOptions: {
        // Include paths to resolve automatically.
        includePaths: ['./bower_components/']
      }
    },
    {
      src: './themes/custom/scaffold/scss/typography/*.scss',
      maps: '../maps',
      prefix: {browsers: 'last 2 versions', cascade: false},
      dest: './themes/custom/scaffold/dist/css/wysiwyg',
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
      src: ['./themes/custom/scaffold/js/**/*.js'],
      concat: false,
      min: true,
      maps: '../maps',
      dest: './themes/custom/scaffold/dist/js'
    },
    {
      src: './bower_components/foundation-sites/dist/foundation.js',
      concat: 'libs.js',
      min: true,
      maps: '../maps',
      dest: './themes/custom/scaffold/dist/js'
    }
  ],
  // Packages of files that will be copied.
  // Files can optionally be passed through imagemin.
  copy: [
    {
      src: './themes/custom/scaffold/images',
      imagemin: true,
      dest: './themes/custom/scaffold/dist/images'
    }
  ],
  // Patterns for PHP files to lint and check.
  phpCheck: ['{modules,themes}/custom/**/*.{php,inc,module,theme,inc}'],
  // Patterns for JS files to lint and check.
  jsCheck: [
    'gulpfile.js',
    'gulpconfig.js',
    '{modules,themes}/custom/**/*.js',
    '!{modules,themes}/custom/**/bower_components/**',
    '!{modules,themes}/custom/**/node_modules/**',
    '!{modules,themes}/custom/**/dist/**'
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
