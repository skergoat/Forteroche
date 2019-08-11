
// open and close the reader 

$(function(){

  $('#open-reader').click(function(){

      if(!$('.container-general').hasClass('reader-open')) {

        $('.container-general').addClass('reader-open');

        $('.container-general').hide();

        $('.container-button-reader').css('width', '100%');

        $('.container-text-reader').css({'width':'100%', 'height' : '100%', 'overflow':'auto'}).css({'width':'100%', 'height':'100%', 'background':'rgba(0, 0, 0, .9)'});

      }

  });

  $('#close-reader').click(function(){

    $('.container-general').removeClass('reader-open');

    $('.container-general').show();

    $('.container-button-reader').css('width', '0%');

    $('.container-text-reader').css({'width':'0%', 'height' : '0%', 'overflow':'hidden'}).css({'width':'0%', 'height':'0%', 'background':'transparent'});

  });

});