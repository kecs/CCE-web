<?php if (0): /* to trick netbeans into JS mode */ ?>
  <script type="text/javascript">
    /* <![CDATA[ */
<?php endif ?>

    $(function () {
      var URL_MEASUREMENT_DATA = $.urlTemplate('<?php echo url_for("measurement_data", array("type" => ":type", "id" => ":id", "channel" => ":channel")) ?>');
      var channels = {};

      channels.Activity = function (channel) {
        var entity = channel.closest('.entity');
        var generalOptions = {
          chart: {
            renderTo: channel[0]
          },
          xAxis: {
            type: 'datetime'
          },
          yAxis: {
          },
          series: new Array
        };

        jQuery.get(URL_MEASUREMENT_DATA.generate({
          id: entity.data('id'),
          type: entity.data('type'),
          channel: channel.data('channel')
        }), {
          from: 1,
          to: 200
        }, function(data) {
          var options = $.extend(true, {}, generalOptions);

          options.yAxis.categories = [];
          options.series[0] = {data : []};
          $.each(data, function () {
            var measurement = this;
            var categoryId = $.inArray(measurement.type, options.yAxis.categories);
            if (categoryId == -1) {
              categoryId = options.yAxis.categories.length;
              options.yAxis.categories.push(measurement.type);
            }
            options.series[0].data.push([measurement.start_time, categoryId]);
            options.series[0].data.push([measurement.end_time, categoryId]);
            options.series[0].data.push(null);
          })

          new Highcharts.Chart(options);
        });
      }

      $('.channel').each(function () {
        var channel = $(this);
        var type = channel.data('channel');
        channels[type](channel);
      });

    });

<?php if (0): ?>
      /* ]]> */
    </script>
<?php endif ?>
