;var Home = {

  init: function () {
    window.setTimeout(function () {
      $('blockquote .first-part').fadeIn(2000, function () {
        window.setTimeout(function () {
          $('blockquote .second-part').fadeIn(2000, function () {
            window.setTimeout(function () {
              $('blockquote .author').fadeIn(2000);
            }, 1000);
          });
        }, 1000);
      });
    }, 750);
  }

};

$(document).ready(function () {
  Home.init();
});
