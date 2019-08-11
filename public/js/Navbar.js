$(function() {

  /**
  * Open and close nav responsive on front and back layout  
  **/

  $(".navbar-burger").click(function() {

      $(".navbar-burger").toggleClass("is-active");
      // $(".navbar-menu").toggleClass("is-active");

      if($('.navbar-burger').hasClass("is-active")) {

        if($('.navbar-burger').hasClass('navbar-burger-back')) {

            $('.nav-responsive').animate({'top':'+=170px'}, 500);
        }
        else {

            $('.nav-responsive').animate({'top':'+=300px'}, 500);
        }

      }
      else {

        if($('.navbar-burger').hasClass('navbar-burger-back')) {

          $('.nav-responsive').animate({'top':'-=170px'}, 500);

        }
        else {

          $('.nav-responsive').animate({'top':'-=300px'}, 500);
        }

      }

  });

  /**
  * nav responsive close when resize 
  **/

  $(window).resize(function(){

    var windowWidth = $(document).width();

    if(windowWidth > 1087 && $('.navbar-burger').hasClass("is-active")) {

      $(".navbar-burger").toggleClass("is-active");

      if($('.navbar-burger').hasClass('navbar-burger-back')) {

          $('.nav-responsive').animate({'top':'-=170px'}, 500);

      }
      else {

          $('.nav-responsive').animate({'top':'-=300px'}, 500);
      }

    }

  });
  
});