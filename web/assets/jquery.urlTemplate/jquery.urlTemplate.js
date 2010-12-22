(function ($) {
  $.urlTemplate = function (str) {
    var template = str;
    return {
      generate: function (params) {
        var out = template;
        $.each(params, function (name, value) {
          out = out.replace('%3A' + name, value);
        });
        return out;
      }
    }
  }
})(jQuery);


