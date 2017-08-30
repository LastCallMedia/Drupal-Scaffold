/**
 * BackstopJS Viewports.
 *
 * This is the "viewports" portion of the Backstop config. A viewport is a size that
 * each element will be captured in.  You can add as many as you like, but it will
 * greatly increase the number of screenshots that are captured, making the tests
 * slower, and the space required for screenshots larger.
 *
 * For more information, see
 *  https://github.com/garris/BackstopJS#here-is-the-configuration-that-backstop-genconfig-generates
 */
module.exports = [
  {
    name: 'phone',
    width: 320,
    height: 480
  },
  {
    name: 'desktop',
    width: 1024,
    height: 768
  }
];
