const Crawler = require('lastcall-nightcrawler');
const Number  = Crawler.metrics.Number;
const Milliseconds = Crawler.metrics.Milliseconds;
const Percent = Crawler.metrics.Percent;

const myCrawler = new Crawler('My Crawler');

myCrawler.on('setup', function (crawler) {
  // On setup, give the crawler a list of URLs to crawl.
  crawler.enqueue('http://localhost:8080/');
});

// Collect additional data about each response.
myCrawler.on('response.success', function (response, data) {
  data.statusMessage = response.statusMessage;
});

myCrawler.on('analyze', function (crawlReport, analysis) {
  // On analysis, derive the metrics you need from the
  // array of collected data.
  var data = crawlReport.data;

  // Calculate the number of requests that were made:
  analysis.add('count', new Number('Total Requests', 0, data.length));

  // Calculate the average response time:
  var avgTime = data.reduce(function (sum, dataPoint) {
    return sum + dataPoint.backendTime
  }, 0) / data.length;
  analysis.add('time', new Milliseconds('Avg Response Time', 0, avgTime));

  // Calculate the percent of requests that were marked failed:
  var failRatio = data.filter(function (dataPoint) {
    return dataPoint.fail === true;
  }).length / data.length;
  var level = failRatio > 0 ? 2 : 0;
  analysis.add('fail', new Percent('% Failed', level, failRatio));

  // Calculate the percent of requests that resulted in a 500 response.
  var serverErrorRatio = data.filter(function (dataPoint) {
    return dataPoint.statusCode >= 500;
  }).length / data.length;
  var level = serverErrorRatio > 0 ? 2 : 0;
  analysis.add('500', new Percent('% 500', level, serverErrorRatio));
});

module.exports = myCrawler;
