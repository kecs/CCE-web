/*jslint newcap: true, undef: true, nomen: true, regexp: true, bitwise: true, strict: true */
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
    };

    channel.entityChannel = undefined;
    channel.chart = undefined;

    channel.update = function (timePeriod) {
      channel.chart.xAxis[0].setExtremes(timePeriod.from, timePeriod.to);
      channel.chart.showLoading();
      jQuery.get($.urlTemplate('<?php echo url_for("measurement_data", array("type" => ":type", "id" => ":id", "channel" => ":channel")) ?>').generate({
        id: this.getEntityId(),
        type: this.getEntityType(),
        channel: this.getChannelType()
      }), timePeriod, function (data) {
        channel.doUpdate(data);
        channel.chart.hideLoading();
      });
    };

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
            seriesData.push([measurement.value, categoryId]);
          } else {
            seriesData.push(measurement);
          }
        });
      });
      this.chart.yAxis[0].setCategories(categories, false);
      this.chart.series[0].setData(seriesData, false);
    };

    channel.getInitOptions = function() {
      return {
        chart: {
          renderTo: this.entityChannel[0],
          zoomType: 'x',
          marginTop: 10,
          marginRight: 10,
          marginBottom: 30,
          marginLeft: 80,
          events: {
            selection: channel.zoom
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
          type: 'datetime'
        },
        yAxis: {
          title: ""
        },
        series: [{
          data:[]
        }]
      };
    };

    channel.zoom = function (event) {
      var timePeriod = {
        from: event.xAxis[0].min,
        to:   event.xAxis[0].max
      };

      $('.channel').each(function () {
        var channel = $(this).data('channelObj');
        
        channel.chart.xAxis[0].setExtremes(timePeriod.from, timePeriod.to);
        
        channel.update(timePeriod);
      });
    

      event.preventDefault();
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

  channelMaker.OpenClosed = function () {
    var channel = channelMaker.Base();

    channel.doUpdate = function (data) {
      this.updateCategorySeries(data, function (row) {
        return {
          category: row.value,
          value: row.timestamp
        };
      });
      this.chart.redraw();
    };

    return channel;
  };

  channelMaker.Motion = function () {
    var channel = channelMaker.Base();

    channel.doUpdate = function (data) {
      this.updateCategorySeries(data, function (row) {
        return {
          category: row.value ? 'true' : 'false',
          value: row.timestamp
        };
      });
      this.chart.redraw();
    };

    return channel;
  };

  channelMaker.Activation = function (chart, data) {
    var channel = channelMaker.Base();

    channel.doUpdate = function (data) {
      this.updateCategorySeries(data, function (row) {
        return {
          category: 'activation',
          value: row.timestamp
        };
      });
      this.chart.redraw();
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