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
      to: 1696122139632
    }, callback);
  }

  function categorySeries(axis, data, processDataRow) {
    var seriesData = [];
    if (axis.categories === undefined) {
      axis.categories = [];
    }
    $.each(data, function (i, dataRow) {
      var measurements = processDataRow(dataRow);
      if (measurements[0] === undefined) {
        measurements = [measurements];
      }
      $.each(measurements, function (i, measurement) {
        if (measurement.category) {

          var categoryId = $.inArray(measurement.category, axis.categories);
          if (categoryId === -1) {
            categoryId = axis.categories.length;
            axis.categories.push(measurement.category);
          }
          seriesData.push([measurement.value, categoryId]);
        } else {
          seriesData.push(measurement);
        }
      });
    });
    return seriesData;
  }

  channels.Activity = function (channel) {
    getDataForChannel(channel, function (data) {
      var options = $.extend(true, {}, generalOptions);
      options.chart.renderTo = channel[0];
      options.series[0] = categorySeries(options.yAxis, data, function (row) {
        return [
        {
          category: row.type,
          value: row.start_time
        },
        {
          category: row.type,
          value: row.end_time
        },
        null
        ];
      });
      return new Highcharts.Chart(options);
    });
  };


  channels.OpenClosed = function (channel) {
    getDataForChannel(channel, function (data) {
      var options = $.extend(true, {}, generalOptions);
      options.chart.renderTo = channel[0];
      options.series[0].data = categorySeries(options.yAxis, data, function (measurement) {
        return {
          category: measurement.value,
          value: measurement.timestamp
        };
      });
      return new Highcharts.Chart(options);
    });
  };

  channels.Motion = function (channel) {
    getDataForChannel(channel, function (data) {
      var options = $.extend(true, {}, generalOptions);
      options.chart.renderTo = channel[0];
      options.series[0].data = categorySeries(options.yAxis, data, function (measurement) {
        return {
          category: measurement.value ? 'true' : 'false',
          value: measurement.timestamp
        };
      });
      return new Highcharts.Chart(options);
    });
  };

  $('.channel').each(function () {
    var channel = $(this);
    var type = channel.data('channel');
    if (channels[type]) {
      channels[type](channel);
    } else {
      channel.text('Error: unkown channel ' + type);
    }
  });

});

