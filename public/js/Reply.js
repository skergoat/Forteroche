/**
*	This class manages all replies functions 
**/

$(function(){

	/**
	*	If focus, danger class is removed form textarea 
	**/
	$('textarea').focus(function(){					 

		if($(this).hasClass('is-danger')) {

			$(this).removeClass('is-danger');
		}
	});


	/**
	*	If blur, danger class is removed form textarea 
	**/
	$('textarea').blur(function(){					  

		if($(this).hasClass('is-danger')) {

			$(this).removeClass('is-danger');
		}
	});


	/**
	*	If user write in textarea, danger class is removed form textarea 
	**/
	$('textarea').keyup(function(e){					

		if(e.keyCode == 13) {

			if($(this).hasClass('is-danger')) {

				$(this).addClass('is-danger');
			}
		}
		else {

			$(this).removeClass('is-danger');
		}
	});



	$('.replyForm').hide();										// reply form hidden by default 


	/**
	*	Hide or show reply form 
	**/
	$('.answer').click(function(){
																// when another form is clicked, the one open is closed
		var OpenId = $(this).attr('id');

		if(!$('.buttonResponse' + OpenId).hasClass('open')){			// when clicked, new form is open 

			$('.answer').removeClass('open');					// when another form is open at the same time, it is closed  

			$('.replyForm').hide();								// we can also close the current open form by clicking a second time on it 

			$('.buttonResponse' + OpenId).addClass('open');

			$('#reportResponse' + OpenId).fadeIn('slow');

		}		
		else if($('.buttonResponse' + OpenId).hasClass('open')){	// when reclicked div is closed 

			$('.buttonResponse' + OpenId).removeClass('open');

			$('#reportResponse' + OpenId).fadeOut('slow');

			setTimeout(function(){

				$('.pseudoInput').removeClass('is-danger');			// hide danger class in form 
				$('.emailInput').removeClass('is-danger');
				$('.messageInput').removeClass('is-danger');

				$('.helpPseudo').text('');
				$('.helpMail').text('');

			}, 500);
		} 

	});


	$('.deleteReply').click(function(e){

		e.preventDefault();

		var replyId = $(this).attr('id');				
        var replyAction = $('#' + replyId + ' span:first-child').attr('id');

        var FormComment = new Reply(replyId, replyAction);
		FormComment.deleteReply();

	});


	/** 
	* submit form 
	**/
	$('.createReply').submit(function(e) {

		e.preventDefault();

		var replyId = $(this).attr('id');
		var replyAction = $(this).attr('action');

		$('.helpPseudo').text('');
		$('.helpMail').text('');

		var FormComment = new Reply(replyId, replyAction);
		FormComment.sendReply();

	});



	class Reply {

		constructor(replyId, replyAction) {

			this.replyId = replyId;
			this.replyAction = replyAction;

		}

		/**
		*	send Reply 
		**/
		sendReply() {

			var replyId = this.replyId;
			var replyAction = this.replyAction;

			$.post(

			this.replyAction,
			{
				message: $('#' + this.replyId + ' .messageInput').val(),
				idReply: $('#' + this.replyId + ' .infoReply').val(),
				postReply: $('#' + this.replyId + ' .postReply').val(),
				adminReply: $('#' + this.replyId + ' .adminReply').val(),
			},

			function(data) {

				// alert(data);

				data = parseFloat(data);

				if(data == 22.5) { 

					alert('seulement 1000 signes autorisés'); 

				} 

				else if(data == 23.5) { 

					alert('veuillez remplir tous les champs, svp'); 

				} 

				else {  

				// if($.isNumeric(data)) {

					// data = parseFloat(data);

					var commentId = $('#' + replyId + ' .infoReply').val();			// inputs val to create reply in JS 
					var postId = $('#' + replyId + ' .postReply').val();
					var adminReply = $('#' + replyId + ' .adminReply').val();


					var nb_Replies = $('.replyNumber' + commentId).length; 			// first time we create a reply, we create a reply container

					if(nb_Replies == 0) {

						$('#buttonAdminReply' + commentId).before('<div style="margin-top:20px;" class="box replyBox" id="replyBox' + commentId + '"></div>');
					}	

																					// create replies in JS
					

					$('#replyBox' + commentId).append('<article class="media containerButton replyNumber' + commentId + ' content-article" id="replies' + data + '"><figure class="media-left user-picture"><p class="image is-64x64"><img src="public/img/admin.png"></p></figure><div class="media-content content-reply"><div class="content content-reply"><p style="display:flex;justify-content: space-between;" class="content-content-reply"><strong>Admin</strong><a id="deleteReply' + data + '" class="delete deleteReplyBis" href="index.php?replyaction=deletereply&id=' + data + '&postid=' + postId + '"><span id="' + data + '"></span><span id="' + commentId + '"></span></a></p><p class="content-comment">' + $('#' + replyId + ' .messageInput').val() + '</p></div></div></article>');


																					// empty form input 
					    
					$('#' + replyId + ' .messageInput').val('');
					$('.helpMessage').text('');

					/**
					*	Callback function to delete replies  
					**/
					$('.deleteReplyBis').click(function(e){

						e.preventDefault();

						var repliesId = $(this).attr('id');				
				        var spanContent = $('#' + repliesId + ' span:first-child').attr('id');

						$.ajax({

							url: $('#' + repliesId).attr('href'),
							type: 'GET',
							dataType: 'text',

							success: function(data) {

								var commentId = $('#' + repliesId + ' span:last-child').attr('id');

								$('#replies' + spanContent).html('').replaceWith( '<article class="media mediaJS" id="mediaJS' + commentId + '"></article>');
								$('.mediaJS').hide();

								$('#mediaJS' + commentId).replaceWith('');						// to avoid first border-top 

								var nb_Replies = $('.replyNumber' + commentId).length; 			// first time we create a reply, we create a reply container

								if(nb_Replies == 0) {

									$('#replyBox' + commentId).html('').replaceWith( '<article class="media mediaJS"></article>');
									$('.mediaJS').hide();
								}

								setTimeout(function(){

									$('.containerReponse').hide();

								}, 1000);

							}

						});

					});
				}
		
			},

			'text',

			);

		}

		/**
		*	Delete Reply 
		**/
		deleteReply() {

			var repliesId = this.replyId;
			var spanContent = this.replyAction;

			$.ajax({

				url: $('#' + repliesId).attr('href'),
				type: 'GET',
				dataType: 'text',

				success: function(data) {

					var commentId = $('#' + repliesId + ' span:last-child').attr('id');

					var replyBox = 'replyBox' + commentId;

					$('#replies' + spanContent).html('').replaceWith( '<article class="media mediaJS" id="mediaJS' + commentId + '"></article>');
					$('.mediaJS').hide();

					$('#mediaJS' + commentId).replaceWith('');						// to avoid first border-top 

					var nb_Replies = $('.replyNumber' + commentId).length; 			// first time we create a reply, we create a reply container

					if(nb_Replies == 0) {

						$('#replyBox' + commentId).html('').replaceWith( '<article class="media mediaJS"></article>');
						$('.mediaJS').hide();
					}
					
					setTimeout(function(){

						$('.containerReponse').hide();

					}, 1000);

				}

			});
				

		}

	}


	
});