$(function(){

  /**
  * Search action main page
  **/

  $('#search-link').click(function(){

    var value = $('#search-value').val();

    if(value == "" || value == null) {

      return false;

    }
    else {

      window.location.href="index.php?postaction=search&keyword=" + value;
    }

  });

  /**
  * Search action search page 
  **/

  $('#search-linkBis').click(function(){

    var value = $('#search-valueBis').val();

    if(value == "" || value == null) {

      return false;

    }
    else {

      window.location.href="index.php?postaction=search&keyword=" + value;

      $('.container-container-search').hide().removeClass('fullWidth').css('width','0%');
      $('html').css('overflow-y', 'scroll');
    }

    

  });


  /**
  * Search modal page 
  **/

  $('.container-container-search').hide();

  // two command to avoid the same id's

  $('#search-open').click(function(e){

    e.preventDefault();

    $('.container-container-search').fadeIn().addClass('fullWidth').css('width','100%');
    $('#search-link').css('opacity', '1');
    $('html').css('overflow-y', 'hidden');
    $('#search-value').addClass('open');
    $('#search-valueBis').addClass('open');

    if($(".navbar-burger").hasClass("is-active")) {

      $(".navbar-burger").toggleClass("");
      $('.nav-responsive').animate({'top':'-=300px'}, 500);

    }

  });

  $('#open-search').click(function(e){

    e.preventDefault();

    $('.container-container-search').fadeIn().addClass('fullWidth').css('width','100%');
    $('#search-link').css('opacity', '1');
    $('html').css('overflow-y', 'hidden');
    $('#search-value').addClass('open');
    $('#search-valueBis').addClass('open');

    if($(".navbar-burger").hasClass("is-active")) {

      $(".navbar-burger").toggleClass("");
      $('.nav-responsive').animate({'top':'-=300px'}, 500);

    }

  });


  $('#search-close').click(function(e){

    e.preventDefault();

    $('.container-container-search').hide().removeClass('fullWidth').css('width','0%');
    $('#search-link').css('opacity', '0');
    $('html').css('overflow-y', 'scroll');
    $('#search-value').removeClass('open');
    $('#search-valueBis').removeClass('open');

  });

});
