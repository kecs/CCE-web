/*jslint newcap: true, undef: true, nomen: true, regexp: true, bitwise: true, strict: true */
/*global jQuery, $, Highcharts */

$(function () {
  "use strict";

  var URL_MEASUREMENT_DATA = $.urlTemplate('<?php echo url_for("measurement_data", array("type" => ":type", "id" => ":id", "channel" => ":channel")) ?>');
  var channels = {};
  var syncedCharts = [];

  Highcharts.setOptions({
    global: {
      useUTC: false //az adatok UTC-ben jonnek at, de a helyi idozonaban kell megjeleniteni oket
    }
  });

  function getDataForChannel(channel, timePeriod, callback) {
    var entity = channel.closest('.entity');

    jQuery.get(URL_MEASUREMENT_DATA.generate({
      id: entity.data('id'),
      type: entity.data('type'),
      channel: channel.data('channel')
    }), timePeriod, callback);
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

  function makeSyncedChart(options) {
    var chart = new Highcharts.Chart(options);
    syncedCharts.push(chart);
    return chart;
  }
  
  function zoom(event) {
    var newTimePeriod = {
      from: event.xAxis[0].min,
      to:   event.xAxis[0].max
    };

    $.each(syncedCharts, function (i, chart) {
      chart.xAxis[0].setExtremes(newTimePeriod.from, newTimePeriod.to);
    });

    event.preventDefault();
  }

  function Options(channel, timePeriod) {
    return {
      chart: {
        renderTo: channel[0],
        zoomType: 'x',
        borderWidth: 1, //debug only
        marginTop: 10,
        marginRight: 10,
        marginBottom: 30,
        marginLeft: 80,
        events: {
          selection: zoom
        }

      },
      credits: {
        enabled: false
      },
      legend: {
        enabled: false
      },
      plotOptions: {
        series: {
      }
      },
      title: {
        text: ""
      },
      xAxis: {
        type: 'datetime',
        min: timePeriod.from,
        max: timePeriod.to
      },
      yAxis: {
        title: ""
      },
      series: []
    };

  }

  channels.Activity = function (channel, timePeriod) {
    getDataForChannel(channel, timePeriod, function (data) {
      var options = new Options(channel, timePeriod);
      options.series[0] = {};
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


  channels.OpenClosed = function (channel, timePeriod) {
    getDataForChannel(channel, timePeriod, function (data) {
      var options = new Options(channel, timePeriod);
      options.series[0] = {};
      options.series[0].data = categorySeries(options.yAxis, data, function (measurement) {
        return {
          category: measurement.value,
          value: measurement.timestamp
        };
      });
      makeSyncedChart(options);
    });
  };

  channels.Motion = function (channel, timePeriod) {
    getDataForChannel(channel, timePeriod, function (data) {
      var options = new Options(channel, timePeriod);
      options.series[0] = {};
      options.series[0].data = categorySeries(options.yAxis, data, function (measurement) {
        return {
          category: measurement.value ? 'true' : 'false',
          value: measurement.timestamp
        };
      });
      makeSyncedChart(options);
    });
  };

  channels.Activation = function (channel, timePeriod) {
    getDataForChannel(channel, timePeriod, function (data) {
      var options = new Options(channel, timePeriod);
      options.series[0] = {};
      options.series[0].data = categorySeries(options.yAxis, data, function (measurement) {
        return {
          category: 'activation',
          value: measurement.timestamp
        };
      });
      makeSyncedChart(options);
    });
  };

  $('.channel').each(function () {
    var channel = $(this);
    var type = channel.data('channel');
    var timePeriod = {
      from: 1295956560000,
      to:   1296145800000
    };

    if (channels[type]) {
      channels[type](channel, timePeriod);
    } else {
      channel.text('Error: unkown channel ' + type);
    }
  });

});
