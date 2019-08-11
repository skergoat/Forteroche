/**
* script for contact form 
**/


$(function(){


	$('.sendMail').submit(function(e){

		e.preventDefault();

		$.ajax({

			type: 'POST',
			url: $(this).attr('action'),
			data: 'username=' + $('#userpseudo').val() + '&usermail=' + $('#useremail').val() + '&usermessage=' + $('#usercontent').val() + "&g-recaptcha-response=" + grecaptcha.getResponse(), 
			datatype: 'text',

			success:function(data) {

				if(data == 'empty') {					// form is empty 

					$('.notification-failed').fadeIn().text('Veuillez remplir tous les champs, svp');

					setTimeout(function(){

						$('.notification-failed').hide();

					}, 2000);
				}
				else if(data == 'invalidEmail') {		// mail is invalid 	

					$('.emailuser').addClass('is-danger').text('mail invalide');
					$('#useremail').addClass('is-danger');

				}
				else if(data == 'tooMuch') {			// message is too long 

					$('.contentuser').addClass('is-danger').text('message trop long');
					$('#usercontent').addClass('is-danger');

				}
				else if(data == 'capchaEmpty') {

					$('.notification-failed').fadeIn().text('Veuillez cocher la Capcha, svp');

					setTimeout(function(){

						$('.notification-failed').hide();

					}, 2000);
				}
				else if(data == 'capchaError') {

					$('.notification-failed').fadeIn().text('Vous etes un robot !');

					setTimeout(function(){

						$('.notification-failed').hide();

					}, 2000);
				}
				else {	

					$('input').val('');
					$('textarea').val('');

					$('.emailuser').removeClass('is-danger').text('');
					$('#useremail').removeClass('is-danger');

					$('.contentuser').removeClass('is-danger').text('');
					$('#usercontent').removeClass('is-danger');

					$('.notification-success').fadeIn().text('Message envoyé');

					setTimeout(function(){

						$('.notification-success').hide();
						grecaptcha.reset();

					}, 2000);
				}

			},

		});

	});

});