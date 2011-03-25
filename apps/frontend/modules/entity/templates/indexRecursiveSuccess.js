/*jslint newcap: true, undef: true, nomen: true, regexp: true, bitwise: true, strict: true, nomen: false */
/*global jQuery, $, Highcharts */

(function () {
  "use strict";

  Highcharts.setOptions({
    global: {
      useUTC: false //az adatok UTC-ben jonnek at, de a helyi idozonaban kell megjeleniteni oket
    }
  });

  var channelMaker = function (entityChannel, timePeriod) {
    var channelType = entityChannel.data('channel');
    if (channelMaker[channelType] === undefined) {
      entityChannel.text('Error: unkown channel ' + channelType);
      return;
    }
    var channel = channelMaker[channelType]();
    channel.init(entityChannel);
    channel.update(timePeriod);
  };

  channelMaker.Base = function () {
    var channel = {};

    channel.init = function (entityChannel) {
      this.entityChannel = entityChannel;
      this.entityChannel.data('channelObj', this);
      this.chart = new Highcharts.Chart(this.getInitOptions());

      this.entityChannel.bind('mousewheel', channel.mouseWheelEvent);
      this.entityChannel.draggable({
        axis: 'x',
        distance: 30,
        helper: function () {
          return $('<div />');
        },
        start: channel.dragStartEvent,
        drag: channel.dragEvent,
        stop: channel.dragStopEvent
      });
    };

    channel.entityChannel = undefined;
    channel.chart = undefined;
    channel.activeRequest = false;

    channel.pagePositionToAxisValues = function (position) {
      return {
        x: channel.chart.xAxis[0].translate(position.left - channel.entityChannel.offset().left - channel.chart.plotLeft, true),
        y: channel.chart.yAxis[0].translate(position.top - channel.entityChannel.offset().top - channel.chart.plotTop, true)
      };
    };

    (function () {
      var mouseValues;
      channel.dragStartEvent = function (event,ui) {
        mouseValues = channel.pagePositionToAxisValues(ui.originalPosition);
      };
      channel.dragStopEvent = function (event,ui) {
        var extremes = channel.chart.xAxis[0].getExtremes();
        channel.zoomTo({
          from: extremes.min,
          to: extremes.max
        });
      };
      channel.dragEvent = function (event,ui) {
        var currentMouseValues = channel.pagePositionToAxisValues(ui.position);
        var dx = mouseValues.x - currentMouseValues.x;

        var extremes = channel.chart.xAxis[0].getExtremes();
        channel.chart.xAxis[0].setExtremes(extremes.min + dx, extremes.max + dx, true, false);
      //not updating mouseValues as we translated to chart so that the current mouse position matches it
      };
    }());

    channel.mouseWheelEvent = function(event, delta, deltaX, deltaY) {
      if (deltaY === 0) {
        return;
      }
      event.preventDefault();
      var currentTimePeriod = channel.getTimePeriod();
      var focus = channel.pagePositionToAxisValues({
        left: event.pageX,
        top: event.pageY
      }).x;

      var zoomFactor;
      if (deltaY < 0) {
        zoomFactor = 2;
      }
      else {
        zoomFactor = 1/2;
      }
      var newTimePeriod = {
        from: focus - (focus - currentTimePeriod.from) * zoomFactor,
        to: focus + (currentTimePeriod.to - focus) * zoomFactor
      };
      
      channel.zoomTo(newTimePeriod);
    };

    channel.getTimePeriod = function () {
      var extremes = channel.chart.xAxis[0].getExtremes();
      return {
        from: extremes.min,
        to: extremes.max
      };
    };
    channel.update = function (timePeriod) {
      channel.chart.showLoading();
      if (channel.activeRequest) {
        channel.activeRequest.abort();
      }
      channel.activeRequest = jQuery.get($.urlTemplate(
        '<?php echo url_for("measurement_data", array("type" => ":type", "id" => ":id", "channel" => ":channel")) ?>').generate({
        id: this.getEntityId(),
        type: this.getEntityType(),
        channel: this.getChannelType()
      }), timePeriod, function (data) {
        channel.activeRequest = false;
        channel.chart.hideLoading();
        channel.chart.xAxis[0].setExtremes(timePeriod.from, timePeriod.to);
        channel.doUpdate(data);
      });
    };

    channel.getInitOptions = function() {
      return {
        chart: {
          renderTo: this.entityChannel[0],
          zoomType: '',
          marginTop: 10,
          marginRight: 10,
          marginBottom: 30,
          marginLeft: 80,
          events: {
            selection: channel.selectEvent
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
        loading: {
          showDuration: 0
        },
        title: {
          text: ""
        },
        xAxis: {
          type: 'datetime',
          labels: {}
        },
        yAxis: {
          title: "",
          labels: {}
        },
        series: [{
          data:[]
        }]
      };
    };

    channel.zoomTo = function (timePeriod) {
      $('.channel').each(function () {
        var channel = $(this).data('channelObj');
        channel.update(timePeriod);
      });
    };
    channel.selectEvent = function (event) {
      event.preventDefault();
      var timePeriod = {
        from: event.xAxis[0].min,
        to:   event.xAxis[0].max
      };
      channel.zoomTo(timePeriod);
    };

    channel.getEntity = function () {
      return this.entityChannel.closest('.entity');
    };
    channel.getEntityId = function () {
      return this.getEntity().data('id');
    };
    channel.getEntityType = function () {
      return this.getEntity().data('type');
    };
    channel.getChannelType = function () {
      return this.entityChannel.data('channel');
    };

    return channel;
  };

  channelMaker.Category = function () {
    var channel = channelMaker.Base();

    channel.updateCategorySeries = function (data, processDataRow) {
      var seriesData = [];
      var categories = [];
      $.each(data, function (i, dataRow) {
        var measurements = processDataRow(dataRow);
        if (measurements[0] === undefined) {
          measurements = [measurements];
        }
        $.each(measurements, function (i, measurement) {
          if (measurement.category) {
            var categoryId = $.inArray(measurement.category, categories);
            if (categoryId === -1) {
              categoryId = categories.length;
              categories.push(measurement.category);
            }

            //extend the data point with concrete coordinates
            measurement.x = measurement.value;
            measurement.y = categoryId;
            seriesData.push(measurement);
          } else {
            seriesData.push(measurement);
          }
        });
      });
      this.chart.yAxis[0].setCategories(categories, false);
      this.chart.series[0].setData(seriesData, false);
    };

    channel.doUpdate = function (data) {
      this.updateCategorySeries(data, channel.processDataRow);
      this.chart.redraw();
    };

    return channel;
  };

  channelMaker.OpenClosed = function () {
    var channel = channelMaker.Category();

    channel.processDataRow = function (row) {
      return {
        category: row.value,
        value: row.timestamp,
        marker: {
          symbol: (row.value === 'closed') ? 'triangle' : 'triangle-down',
          fillColor: (row.value === 'closed') ? '#C0C0C0' : '#CC0000'
        }
      };
    };

    return channel;
  };

  channelMaker.Motion = function () {
    var channel = channelMaker.Category();

    channel.processDataRow = function (row) {
      return {
        category: row.value ? 'true' : 'false',
        value: row.timestamp
      };
    };

    return channel;
  };

  channelMaker.Activation = function (chart, data) {
    var channel = channelMaker.Category();

    channel.processDataRow = function (row) {
      return {
        category: 'activation',
        value: row.timestamp
      };
    };

    return channel;
  };

  $(function () {
    $('.channel').each(function () {
      var channel = $(this);
      var timePeriod = {
        from: 1295956560000,
        to:   1296145800000
      };
      
      channelMaker(channel, timePeriod);
    });
  });

}());