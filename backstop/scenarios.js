(function() {
  var baseUrl = process.env.BASE_URL || 'http://127.0.0.1:8888';

  module.exports = [
    {
      "label": "Homepage",
      "url": baseUrl + '/',
      "hideSelectors": [],
      "removeSelectors": [],
      "selectors": [
        "document"
      ],
      "readyEvent": null,
      "delay": 500,
      "misMatchThreshold" : 0.1,
    }
  ];
})()

