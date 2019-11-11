/* eslint-env node */

var docroot = './web';

module.exports = {
  version: 1,
  scss: {
    theme: {
      src: docroot + '/themes/custom/scaffold/scss/**/*.scss',
      maps: '../maps',
      prefix: {cascade: false},
      dest: docroot + '/themes/custom/scaffold/dist/css',
      // Pass options to node-sass.
      sassOptions: {
        // Include paths to resolve automatically.
        includePaths: ['./node_modules/']
      }
    }
  },
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
  copy: {
    theme: {
      src: [docroot + '/themes/custom/scaffold/images/*'],
      imagemin: false, // Requires gulp-imagemin package.
      dest: docroot + '/themes/custom/scaffold/dist/images'
    }
  }
};
