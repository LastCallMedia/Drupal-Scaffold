
const Crawler = require('lastcall-nightcrawler');
const Number  = Crawler.metrics.Number;
const Milliseconds = Crawler.metrics.Milliseconds;
const Percent = Crawler.metrics.Percent;

const myCrawler = new Crawler('My Crawler');

// Use a base and urls from json file.
// Location of the json file being used.
const pages = require('./backstop/page');
const environments = require('./backstop/environment');

function parseOpt(optname, defaultValue = undefined) {
  const matches = process.argv.filter(arg => arg.indexOf(`--${optname}=`) === 0);
  return matches.length ? matches[0].replace(`--${optname}=`, '') : defaultValue
}

// Determine the proper environment to point at.
const target = parseOpt('target', 'local');
let environment;
if(target in environments) {
  environment = environments[target];
}
else if(target.match(/^http:/)) {
  environment = {name: 'Local', url: target}
}
else {
  throw new Error(`--target flag must be set to a known environment or a URL. ${target} is not known.`)
}

myCrawler.on('setup', function(crawler) {
  // On setup, give the crawler a list of URLs to crawl by combining the
  // page URLs with the base URL.
  pages.forEach(page => crawler.enqueue(`${environment.url}${page.url}`))
});

// Collect additional data about each response.
myCrawler.on('response.success', function (response, data) {
  data.statusMessage = response.statusMessage;
});

/**
 * Analyze the data once it's been collected.
 */
myCrawler.on('analyze', function (crawlReport, analysis) {
  // On analysis, derive the metrics you need from the
  // array of collected data.
  var data = crawlReport.data;

  // Calculate the number of requests that were made:
  analysis.addMetric('count', new Number('Total Requests', 0, data.length));

  // Calculate the average response time:
  var avgTime = data.reduce(function (sum, dataPoint) {
    return sum + dataPoint.backendTime
  }, 0) / data.length;
  analysis.addMetric('time', new Milliseconds('Avg Response Time', 0, avgTime));

  // Calculate the percent of requests that were marked failed:
  var failRatio = data.filter(function (dataPoint) {
    return dataPoint.fail === true;
  }).length / data.length;
  var level = failRatio > 0 ? 2 : 0;
  analysis.addMetric('fail', new Percent('% Failed', level, failRatio));

  // Calculate the percent of requests that resulted in a 500 response.
  var serverErrorRatio = data.filter(function (dataPoint) {
    return dataPoint.statusCode >= 500;
  }).length / data.length;
  var level = serverErrorRatio > 0 ? 2 : 0;
  analysis.addMetric('500', new Percent('% 500', level, serverErrorRatio));

  data.forEach(function(request) {
    var level = request.statusCode > 499 ? 2 : 0
    analysis.addResult(request.url, level)
  });
});

module.exports = myCrawler;
