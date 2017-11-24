/* eslint-env node */

(function () {
  'use strict';

  var ip = require('ip');

  // The folder the web accessible code lives in.
  // @docroot
  var docroot = './web';

  var baseUrl = 'http://' + ip.address() + ':8888';
  var phpPatterns = [docroot + '/{modules,themes}/custom/**/*.{php,inc,module,theme,inc,install}'];
  var jsPatterns = [
    'gulpfile.js',
    'gulpconfig.js',
    docroot + '/{modules,themes}/custom/**/*.js',
    '!' + docroot + '/{modules,themes}/custom/**/bower_components/**',
    '!' + docroot + '/{modules,themes}/custom/**/node_modules/**',
    '!' + docroot + '/{modules,themes}/custom/**/dist/**'
  ];


  var options = {
    version: 1,
    composer: {
      src: './composer.json'
    },
    phpcs: {
      src: phpPatterns,
      bin: 'vendor/bin/phpcs',
      standard: 'vendor/drupal/coder/coder_sniffer/Drupal'
    },
    phplint: {
      src: phpPatterns
    },
    eslint: {
      src: jsPatterns
    },
    // Packages of SCSS that will be compiled.
    scss: {
      theme: {
        src: docroot + '/themes/custom/scaffold/scss/**/*.scss',
        maps: '../maps',
        prefix: {browsers: 'last 2 versions', cascade: false},
        dest: docroot + '/themes/custom/scaffold/dist/css',
        // Pass options to node-sass.
        sassOptions: {
          // Include paths to resolve automatically.
          includePaths: ['./node_modules/']
        }
      }
    },
    // Packages of javascript that will be compiled.
    js: {
      'theme-custom': {
        src: [docroot + '/themes/custom/scaffold/js/**/*.js'],
        concat: false,
        min: true,
        maps: '../maps',
        dest: docroot + '/themes/custom/scaffold/dist/js'
      },
      'theme-libs': {
        src: [
          './node_modules/what-input/dist/what-input.js',
          './node_modules/foundation-sites/dist/js/foundation.js'
        ],
        concat: 'libs.js',
        min: true,
        maps: '../maps',
        dest: docroot + '/themes/custom/scaffold/dist/js'
      }
    },
    // Packages of files that will be copied.
    copy: {
      theme: {
        src: [docroot + '/themes/custom/scaffold/images'],
        imagemin: false, // Requires gulp-imagemin package.
        dest: docroot + '/themes/custom/scaffold/dist/images'
      }
    },
    phpunit: {
      src: './phpunit.xml.dist',
      bin: './vendor/bin/phpunit'
    },
    behat: {
      bin: './vendor/bin/behat',
      baseUrl: baseUrl,
      src: './behat.yml'
    }
  };

  module.exports = options;
})();
