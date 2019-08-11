/**
*  This class manages all comments functions : 
*   - create comment 
*   - report comment 
*   - moderate comment (validate or delete) 
**/

$(function(){

  /**
  * smooth scroll 
  **/

  $('a[href^="#"]').click(function(){

    var the_id = $(this).attr("href");

    if (the_id === '#') {

      return;

    }

    $('html, body').animate({

      scrollTop:$(the_id).offset().top

    }, 'slow');

    return false;

  });


  /**
  * Dropdown buttons                        
  **/
  $('.commentActions').click(function(){

    var dropId = $(this).attr('id');

    if(!$('#' + dropId).hasClass('is-active')){

      $('#' + dropId).addClass('is-active');

    }
    else if ($('#' + dropId).hasClass('is-active')){

      $('#' + dropId).removeClass('is-active');
    }

  });

  /* close when click on item */

  $('.dropdown-item').click(function(){

      var itemId = $(this).attr('id');

      var itemClass = $('#' + itemId + ' span').attr('class');

      $('#actions' + itemClass).removeClass('is-active');

  });

  /* close dropdown when click outside of element */

  $(window).click(function()
  {
      $('.commentActions').removeClass('is-active');
  });

  $('.commentActions').click(function(e)
  {
      e.stopPropagation();
  });


  /**
  * create Comment
  **/
  $('.sendComment').submit(function(e){

      e.preventDefault();

      var postCommentId = $(this).attr('id');
      var spanContent = null;
      var input1 = $('.first').attr('id');
      var input2 = $('.second').attr('id');
      var input3 = $('.third').attr('id');

      var commentManage = new Comment(postCommentId, spanContent, input1, input2, input3);
      commentManage.sendComment();

  });

  var nb_element_de_class3 = $('.rowTable').length;
  var alertInfo = parseFloat($('.alertInfo').text());

  /**
  * Report, validate or delete comment 
  **/
  $('.commentButton').click(function(e){

      	e.preventDefault();

      	var commentId = $(this).attr('id');				
        var spanContent = $('#' + commentId + ' span').attr('id');

      	var commentManage = new Comment(commentId, spanContent);
        commentManage.validateOrDelete();

	});


  	class Comment {

  		constructor(commentId, spanContent, input1, input2, input3){

  			this.commentId = commentId;
        this.spanContent = spanContent;
        this.input1 = input1;
        this.input2 = input2;
        this.input3 = input3;
  		}

      /**
      * Create comment
      **/
      sendComment() {

        var input1 = this.input1;
        var input2 = this.input2;
        var input3 = this.input3;

        $.post(

          $('#' + this.commentId).attr('action'),
          {
            author: $('#' + this.input1).val(),
            mail: $('#' + this.input2).val(),
            contentComment: $('#' + this.input3).val(),
          },

          function(data) {

            if(data == 'empty') {

              $('.notification-failed').show().text("Remplissez tous les champs, svp");

              setTimeout(function(){

                $('.notification-failed').fadeOut();

              }, 1000);

            }

            else if(data == 'tooLong') {

              $('.notification-failed').show().text("Seulement 1000 signes autorisés");

              setTimeout(function(){

                $('.notification-failed').fadeOut();

              }, 1000);

            }

            else if(data == 'invalidMail') {

              $('.second').addClass('is-danger');
              $('.mail').text("Mail invalide");

            }

            else if(data == 'success') {

              $('.second').removeClass('is-danger');
              $('.mail').text("");

              $('#' + input1).val('');
              $('#' + input2).val('');  
              $('#' + input3).val('');            
              $('.notification-success').show().text("Votre commentaire est bien enregistré. Il sera publié après modération");

              setTimeout(function(){

                $('.notification-success').fadeOut();

              }, 1000);


            }

          },

          'text',

        );

      }

      /**
      * Validate or delete on reported on page 
      **/
  		validateOrDelete(){

        var commentId = this.commentId;
        var spanContent = this.spanContent;

  			$.ajax({

  				url: $('#' + commentId).attr('href'),
  				type: 'GET',
  				dataType: 'text',

  				success: function(data) {

  					if(data == 'failed') {

  						window.location.href = "/index.php?adminaction=logout";
  					}
  					else {

              /**
              * success message
              **/

              switch(commentId) {

                case 'validate' + spanContent:

                $('#message' + spanContent).html('').replaceWith( '<div class="notification containerReponse is-success">Commentaire validé</div>');
                $('#check' + spanContent).html('').replaceWith('<i class="fas fa-share-square" title="répondre"></i>');
                $('#validate' + spanContent).removeClass('validate').removeClass('commentButton');


                 var iconLength = $('.fa-check-square.check-icon').length;

                 if(iconLength >= 0) {

                    alertInfo -= 1; 

                    if(alertInfo == 0) {

                      $('.alert-icon').hide();
                      $('.alert-icon-responsive').hide();
                    }

                 }

                // validation in all-comments table 

                var postid = $('#validate' + spanContent + ' span:nth-child(2)').attr('class');     // share button replace check button
                $('#validate' + spanContent).attr('href', 'index.php?postaction=post&id=' + postid);

                $('#validate' + spanContent).click(function(){

                  window.location.href= "index.php?postaction=post&id=" + postid;

                });

                if($('#Lu' + spanContent + ' span').text() == 'oui') {

                  $('#Verifie' + spanContent).html('').append('<span style="color:green;">non</span>');
                }
                else {

                  $('#Lu' + spanContent).html('').append('<span style="color:blue;">oui</span>');     // 'oui' in blue 
                }
                break;

                case 'destroy' + spanContent:
                $('#message' + spanContent).html('').replaceWith( '<div class="notification containerReponse is-danger">Commentaire supprimé</div>');
                $('#tr' + spanContent).fadeOut();

                // callback function when row is deleted in all-comment table  

                nb_element_de_class3 -= 1;

                if($('.pagination-name').text() == 'table') {

                    var paginate = $('.pagination-info').text();
                    var newPaginate = paginate - 1;

                  if(nb_element_de_class3 == 0) { 
                                                                                          // redirect to former page 
                      window.location.href = "index.php?comaction=reply"; 

                  }

                }

                break;

                case 'report' + spanContent:
                $('#reportResponse' + spanContent).html('');
                $('.reply' + spanContent).html('').replaceWith('');
                $('#replyBox' + spanContent).html('').replaceWith('');
                $('#media' + spanContent).html('').replaceWith( '<div class="notification containerReponse is-success">Commentaire signalé</div>');
                break;

                case 'post' + spanContent:
                $('#reportResponse' + spanContent).html(''); // fait sauter
                $('.reply' + spanContent).html('').replaceWith(''); 
                $('#media' + spanContent).html('').replaceWith( '<div class="notification containerReponse is-danger">Commentaire supprimé</div>');
                break;

              }

              setTimeout(function() {                                     // make success or fail notification disappear 

                 $(".notification").fadeOut();

              }, 500); 

              // callback functions when user validate or delete comments 
              // on moderate or reported pages 

              var nb_element_de_class1 = $('.reported').length; 
                var nb_element_de_class2 = $('.moderate').length;


                // on reported page 
                if($('.pagination-name').text() == 'reported') {

                  var paginate = $('.pagination-info').text();
                  var newPaginate = paginate - 1;

                  if(nb_element_de_class1 == 0) {

                    paginateComments($('.pagination-name').text()); 

                  }
                }

                // on moderate page 
                if($('.pagination-name').text() == 'moderate') {

                    var paginate = $('.pagination-info').text();
                    var newPaginate = paginate - 1;

                    if(nb_element_de_class2 == 0) { 

                      paginateComments($('.pagination-name').text()); 

                  }
                }

                // function for moderate and reported page 
                function paginateComments(className) {

                  if(newPaginate > 0) {

                      setTimeout(function() {                            // redirect to former page 

                      window.location.href = "index.php?comaction=moderate&action=" + className + "&paginate=" + newPaginate; 

                     }, 1000);

                  }
                  else {

                      setTimeout(function() {                            // redirect to former page 

                      window.location.href = "index.php?comaction=moderate&action=" + className; 

                    }, 1000);
                  }
                }
           
  					}
  		
  				}

			  });

  		}

  	}


});

