// Generated by CoffeeScript 2.1.0
(function () {
  $(function () {
    $.growl({
      title: "Growl",
      message: "Hi I'm Sash"
    });

	 $('.error').click(function (event) {
      event.preventDefault();
      event.stopPropagation();
      return $.growl.error({
        message: "please check Your details ...file is missing"
      });
    });
    $('.notice').click(function (event) {
      event.preventDefault();
      event.stopPropagation();
      return $.growl.notice({
        message: "You have 4 notification"
      });
    });
    return $('.warning').click(function (event) {
      event.preventDefault();
      event.stopPropagation();
      return $.growl.warning({
        message: "read all details carefully"
      });
    });
  });
}).call(this);
