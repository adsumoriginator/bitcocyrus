<!DOCTYPE html>
<head>
  <meta charset="utf-8">

  <title>d3 depth chart</title>

  <script type="text/javascript" src="https://d3js.org/d3.v4.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lodash@4.17.4/lodash.min.js"></script>

  <style>
    .bar-bids {
      fill: cornflowerblue; }

    .bar-asks {
      fill: pink; }

    .depth-chart {
      display: inline-block;
      float: left; }

  </style>
  
</head>

<body>

<div id="bids" class="depth-chart">

</div>

<div id="asks" class="depth-chart">

</div>

<script>

  /** BIDS =============================================== */
  function bids (__id) {
    var margin = {top: 12, right: 0, bottom: 12, left: 12},
      width = 220 - margin.left - margin.right,
      height = 220 - margin.top - margin.bottom

    // set the ranges
    var x = d3.scaleBand()
      .range([0, width])
      .padding(0.1)
    var y = d3.scaleLinear()
      .range([height, 0])

    // append the svg object to a div ID
    var svg = d3.select('#' + __id).append('svg')
      .attr('width', width + margin.left + margin.right)
      .attr('height', height + margin.top + margin.bottom)
      .append('g')
      .attr('transform',
        'translate(' + margin.left + ',' + margin.top + ')')

    var prefixSum = function (arr) {
      var builder = function (acc, n) {
        var lastNum = acc.length > 0 ? acc[acc.length-1] : 0;
        acc.push(lastNum + n);
        return acc;
      };
      return _.reduce(arr, builder, []);
    }

    var data = []
    var __cum_data = []

    // get the data
    d3.json('http://localhost/market_depth/order_book.json', function (__order_book) {

      data = []
      
      // create cumulative data array
      __cum_data = []
      console.log('__order_book bids', __order_book);
      for (var i = 0; i < __order_book.bids.length; i++) {
        __cum_data.push(__order_book.bids[i].amount)
      }
      var cum_data_array = prefixSum(__cum_data)
      
      // final data array
      for (var i = 0; i < __order_book.bids.length; i++) {
        data.push({
          idx: __order_book.bids[i].price,
          orders: cum_data_array[i]
        })
      }
      
      // reverse data for bids
      data = _.reverse(data)

      data.forEach(function (d) {
        d.orders = +d.orders
      })

      // Scale the range of the data in the domains
      x.domain(data.map(function (d) { return d.idx }))
      y.domain([0, d3.max(data, function (d) { return d.orders })])

      svg.selectAll('.bar-bids')
        .remove('rect')

      // append the rectangles for the bar chart
      svg.selectAll('.bar')
        .data(data)
        .enter().append('rect')
        .attr('class', 'bar')
        .attr('class', 'bar-bids')
        .attr('x', function (d) { return x(d.idx) })
        .attr('width', x.bandwidth())
        .attr('y', function (d) { return y(d.orders) })
        .attr('height', function (d) { return height - y(d.orders) })

    })

  }

  /** ASKS =============================================== */
  function asks (__id) {
    var margin = {top: 12, right: 12, bottom: 12, left: 0},
      width = 220 - margin.left - margin.right,
      height = 220 - margin.top - margin.bottom

    // set the ranges
    var x = d3.scaleBand()
      .range([0, width])
      .padding(0.1)
    var y = d3.scaleLinear()
      .range([height, 0])

    // append the svg object to a div ID
    var svg = d3.select('#' + __id).append('svg')
      .attr('width', width + margin.left + margin.right)
      .attr('height', height + margin.top + margin.bottom)
      .append('g')
      .attr('transform',
        'translate(' + margin.left + ',' + margin.top + ')')

    var prefixSum = function (arr) {
      var builder = function (acc, n) {
        var lastNum = acc.length > 0 ? acc[acc.length-1] : 0;
        acc.push(lastNum + n);
        return acc;
      };
      return _.reduce(arr, builder, []);
    }

    var data = []
    var __cum_data = []

    // get the data
    d3.json('http://localhost/market_depth/order_book.json', function (__order_book) {
      data = []
      __cum_data = []
      console.log('__order_book asks', __order_book);
      for (var i = 0; i < __order_book.asks.length; i++) {
        __cum_data.push(__order_book.asks[i].amount)

      }
      
      // create cumulative data array
      var cum_data_array = prefixSum(__cum_data)
      
      // final data array
      for (var i = 0; i < __order_book.asks.length; i++) {
        data.push({
          idx: __order_book.asks[i].price,
          orders: cum_data_array[i]
        })
      }

      data.forEach(function (d) {
        d.orders = +d.orders
      })

      // Scale the range of the data in the domains
      x.domain(data.map(function (d) { return d.idx }))
      y.domain([0, d3.max(data, function (d) { return d.orders })])

      svg.selectAll('.bar-asks')
        .remove('rect')

      // append the rectangles for the bar chart
      svg.selectAll('.bar')
        .data(data)
        .enter().append('rect')
        .attr('class', 'bar')
        .attr('class', 'bar-asks')
        .attr('x', function (d) { return x(d.idx) })
        .attr('width', x.bandwidth())
        .attr('y', function (d) { return y(d.orders) })
        .attr('height', function (d) { return height - y(d.orders) })

    })

  }

  // call functions with div ID's
  bids('bids')
  asks('asks')

</script>
</body>