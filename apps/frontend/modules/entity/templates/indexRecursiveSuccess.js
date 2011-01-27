/*jslint newcap: true, undef: true, nomen: true, regexp: true, bitwise: true, strict: true, maxerr: 50, indent: 2 */
/*global jQuery, $, Highcharts */

$(function () {
  "use strict";

  var URL_MEASUREMENT_DATA = $.urlTemplate('<?php echo url_for("measurement_data", array("type" => ":type", "id" => ":id", "channel" => ":channel")) ?>');
  var channels = {};
  var generalOptions = {
    chart: {
    },
    xAxis: {
      type: 'datetime'
    },
    yAxis: {
    },
    series: [{
      data : []
    }]
  };

  function getDataForChannel(channel, callback) {
    var entity = channel.closest('.entity');

    jQuery.get(URL_MEASUREMENT_DATA.generate({
      id: entity.data('id'),
      type: entity.data('type'),
      channel: channel.data('channel')
    }), {
      from: 1,
      to: 200
    }, callback);
  }

  channels.Activity = function (channel) {
    getDataForChannel(channel, function (data) {
      var options = $.extend(true, {}, generalOptions);
      options.yAxis.categories = [];

      $.each(data, function (i, measurement) {
        var categoryId = $.inArray(measurement.type, options.yAxis.categories);
        if (categoryId === -1) {
          categoryId = options.yAxis.categories.length;
          options.yAxis.categories.push(measurement.type);
        }
        options.series[0].data.push([measurement.start_time, categoryId]);
        options.series[0].data.push([measurement.end_time, categoryId]);
        options.series[0].data.push(null);
      });

      Highcharts.Chart(options);
    });
  };

  channels.OpenClosed = function (channel) {
    getDataForChannel(channel, function (data) {
      var options = $.extend(true, {}, generalOptions);
      Highcharts.Chart(options);
    });
  };

  $('.channel').each(function () {
    var channel = $(this);
    var type = channel.data('channel');
    channels[type](channel);
  });

});

