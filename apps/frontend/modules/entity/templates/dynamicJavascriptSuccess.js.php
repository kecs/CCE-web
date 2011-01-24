$(function () {
  // define the options
  var options = {

    title: {
      text: 'Daily visits at www.highcharts.com'
    },

    xAxis: {
      type: 'datetime'
    },
    yAxis: {
  }
  }

  jQuery.get($.urlTemplate('<?php echo url_for("measurement_data",array("type" => "entity", "id" => ":id", "module" => ":module")) ?>').generate({
    id: 2,
    module: 'activity'
  }), {
    from: 15,
    to: 200
  }, function(data) {

    });

});
