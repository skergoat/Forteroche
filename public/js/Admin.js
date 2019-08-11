/**
*  This class manages all Admin functions : 
* 	- authentication
*	- create, delete or update admin
*	- recover forgottent password 
**/	


$(function() {

	$('.notification').hide(); 						// Form alert hidden by default 

	/**
	*	send all forms with keyboard
	**/

	$(document).keydown(function(e){

		if(e.keyCode == 13 && $('#updatePost').length > 0){

			e.preventDefault();

			e.stopPropagation();

			return false;
			
		}
		else if(e.keyCode == 13 && $('.fa-check-square').length > 0) {

			var testid = $('.commentButton.validate').attr('id');

			$('#' + testid).click();

			return false;

		}
		else if(e.keyCode == 13 && $('#search-value').hasClass('open')) {

			$('#search-link').click();

		}
		else if(e.keyCode == 13 && $('#search-valueBis').hasClass('open')) {

			$('#search-linkBis').click();
			
		}
		else if(e.keyCode == 13) {

			$('form').submit();
	    	return false;

		}

	});

	/**
	*	when click on document, input loose 'is-danger class' and form help become empty
	**/

	$(document).click(function(){

		$('.input').removeClass('is-danger').text('');
		$('.help').text('');

		$('textarea').removeClass('is-danger');

	});


	/**
	*	If user write in input, danger class is removed form input 
	**/
	$('.input').keyup(function(e){					

		if(e.keyCode == 13) {

			if($(this).hasClass('is-danger')) {

				$(this).addClass('is-danger');
			}
		}
		else {

			$(this).removeClass('is-danger');
			$('.help').text('');
		}
	});

	
	/** 
	*	If form is sent  
	**/

	var formId = $('.formulaire').attr('id');		// form id 

	$('#' + formId).submit(function(e) {			

    	e.preventDefault();

    	$('.help').text('');						// empty the "help" div when send Form
    	$('.notification').hide();					// hide notification alert when send Form


    	/**
    	*	send HTML data to the class 
    	**/

		var input1 = $('.first').attr('id');		// input values 
		var input2 = $('.second').attr('id');
		var input3 = $('.third').attr('id');

		if(input3 == "undefined") { input3 = null; }

    	var form = new Form(formId, input1, input2, input3);
    	form.postForm(); 

  	});

 	/**
 	*	Delete row 
 	**/
  	$('.AdminJS').click(function(e) {	

		e.preventDefault();

		var adminId = $(this).attr('id');			// get button id 
		var classAdmin = $('#' + adminId + ' span').attr('id');		// get button class

		$.ajax({

			url: $('#' + adminId).attr('href'),
			type: 'GET',
			dataType: 'text',

			success: function(data) {

				$('#delete-admin' + classAdmin).fadeOut('slow');
			}

		});

	});


	const ajaxReturn = {

		/** 
		*	show success or failed notification 
		**/

		ajaxResponse(){

		  var formSuccess = this.formReponse1;
		  var formDanger = this.formReponse2; 

	      if(this.data == 'success') {

	      	 $('#form-admin').css('display', 'block'); 

             this.formReponse2.hide();								// hide failed alert

             this.formReponse1.fadeIn(); 							// show success alert 
	         this.formReponse1.text(this.reponse);

           	setTimeout(function() {									// hide success alert 

	          formSuccess.hide();

	        }, 2000);

	      }

	      else if(this.data == 'empty' || this.data == 'failed' || this.data == 'error') {

	         this.formReponse1.hide();								// hide success alert 

	         this.formReponse2.fadeIn(); 							// show failed alert 
	         this.formReponse2.text(this.reponse);

	         setTimeout(function() {								// hide success alert 

	          formDanger.hide();

	        }, 2000);

	      }
 
		}

	};
  
  	/** 
	*	params for constant  
	**/

	class ajaxVars {

		 constructor(data, reponse){								// constant variables 

		 	this.formReponse1 = $('.notification-success');
		 	this.formReponse2 = $('.notification-failed');
		 	this.data = data; 
		    this.reponse = reponse;
		}	

	}

	class Form {

		constructor(formId, input1, input2, input3) {				

			this.formId = formId;
			this.input1 = input1; 
			this.input2 = input2;
			this.input3 = input3;
		}


		/** 
		*	post form with ajax   
		**/

		postForm() {
															
			Object.setPrototypeOf(ajaxVars.prototype, ajaxReturn); 		

			var input1 = this.input1;					// to create for ex. a new row in admin table	
			var input2 = this.input2;
			var input3 = this.input3;
			var formId = this.formId;

			$.post(											

		      $('#' + this.formId).attr('action'), 
		      {
		          name : $('#' + this.input1).val(),  
		          password : $('#' + this.input2).val(),
		          nameAdmin: $('#' + this.input1).val(),
		          passwordAdmin: $('#' + this.input2).val(),
		          mailAdmin:$('#' + this.input3).val(),
		          updateName: $('#' + this.input1).val(),
		          updateMail:$('#' + this.input2).val(),
		          formerPassword: $('#' + this.input1).val(), 
		          newPassword: $('#' + this.input2).val(),
		          recoverMail: $('#' + this.input1).val(),
		          recoverCode: $('#' + this.input1).val(), 
		          recoveredPass: $('#' + this.input2).val(), 
		          confirmRecoveredPass: $('#' + this.input1).val(), 
		      },

		      function(data){


		      	/**
		        *	Empty form 
		        **/
		        if(data == 'empty'){					

		            var reponse = "remplissez tous les champs, svp";
		            var ajaxReturn = new ajaxVars(data, reponse);
		            ajaxReturn.ajaxResponse(); 

		        }

		        /**
		        *	Request not complete 
		        **/
		      	else if(data == 'failed'){					

		        	switch(formId) {

		        		case "signIn":  					      // bad credentials 
		        		var reponse = "mot de passe ou identifiant incorrects";
		           		var ajaxReturn = new ajaxVars(data, reponse);
		            	ajaxReturn.ajaxResponse();
		            	break;
		            										     // if admin is disconnected while user is in the admin interface, actions cannot be done
		            	case "createAdmin":
		            	case "updateAdmin":
		            	window.location.href = "/projet_4/index.php?adminaction=admin";
		            	break;

		            	case "updatePassword": 					// if former password we want to update is incorrect 
		            	$('.first').addClass('is-danger');
		            	$('.lastPassword').text("Ancien mot de passe incorrect");
		            	break;

		            	case "recover":   					    // unknown email
		            	$('.first').addClass('is-danger');
		            	$('.mail').text("Mail inconnu");
		            	break;

		            	case "recoverCodePage":  			    // unknown code
		            	$('.first').addClass('is-danger');
		            	$('.password').text("Code Incorrect");
		            	break;

		            	case "recoverPassword":                 // confirme recovered password
		            	$('.second').addClass('is-danger');
		            	$('.password').text("Les mots de passe ne sont pas identiques");
		            	break;

		        	}

		        }


		        /**
		        *	Enable admin when not valid anymore 
		        **/
		        else if(data == 'error') { 					

		        	if(formId == 'recover') {

		        		var reponse = "Le mail ne fonctionne pas";
		           		var ajaxReturn = new ajaxVars(data, reponse);
		            	ajaxReturn.ajaxResponse();
		        	}
		        	else {

		        		window.location.href = "/projet_4/index.php?adminaction=logout";
		        	}
		        	
		        }
				

		        /**
		        *	Credential already exists in bdd  
		        **/
		        else if(data == 'similarMail' || data == 'similarPassword' || data == 'similarName' || data == 'similarUpdateMail') { 

		        	switch(data) {

		        		case 'similarName':
		           		$('.first').addClass('is-danger');
		           		$('.name').text("Nom déjà utilisé");
		           		break;

		           		case 'similarPassword':
		            	$('.second').addClass('is-danger');
		            	$('.password').text("Mot de passe déjà utilisé");
		           		break;

		        		case 'similarMail':
		            	$('.third').addClass('is-danger');
		            	$('.mail').text("Email déjà utilisé");
		            	break;

		            	case 'similarUpdateMail':
		            	$('.second').addClass('is-danger');
		            	$('.mail').text("Email déjà utilisé");
		            	break;

		        	}

		        }
		        												

		        /**
		        *	credential are not valid (regex)
		        **/
		        else if(data == 'invalidName' || data == 'notEnough' || data == 'notUpper' || data == 'noNumber' || data == 'noSpecial' || data == 'invalidMail' || data == 'invalidUpdateMail' || data == 'invalidRecoveredMail') {

		        	switch(data) {

		        		case 'invalidName':
		           		$('.first').addClass('is-danger');
		           		$('.name').text("Le nom doit comporter au moins 2 caractères");
		           		break;

		           		case 'notEnough':
		            	$('.second').addClass('is-danger');
		            	$('.password').text("Le mot de passe doit comporter au moins 8 caractères");
		           		break;

		           		case 'notUpper':
		            	$('.second').addClass('is-danger');
		            	$('.password').text("Le mot de passe doit comporter au moins 1 majuscule");
		           		break;

		           		case 'noNumber':
		            	$('.second').addClass('is-danger');
		            	$('.password').text("Le mot de passe doit comporter au moins 1 caractère numérique");
		           		break;

		           		case 'noSpecial':
		            	$('.second').addClass('is-danger');
		            	$('.password').text("Le mot de passe doit comporter au moins 1 caractère special");
		           		break;

		        		case 'invalidMail':
		            	$('.third').addClass('is-danger');
		            	$('.mail').text("Mail invalide");
		            	break;

		            	case 'invalidUpdateMail':
		            	$('.second').addClass('is-danger');
		            	$('.mail').text("Mail invalide");
		            	break;

		            	case 'invalidRecoveredMail':
		            	$('.first').addClass('is-danger');
		            	$('.mail').text("Mail invalide");
		            	break;

		        	}

		        }

		       
		       	/**
		      	*	Authentication
		      	**/
		      	else if(data == "signin") { 

		            window.location.href = "/projet_4/index.php?postaction=managearticles";
		        }

		        
		        /**
		        *	Request complete 
		        **/
		        else if(data == 'success'){					

		            switch(formId) {

		                case "updateAdmin":
		                var reponse = "Modifications enregistrées !";
		                var ajaxReturn = new ajaxVars(data, reponse);
		            	ajaxReturn.ajaxResponse(); 
		                break;

		                case "updatePassword":             // update admin password 
		                $('#' + input1).val('');
		                $('#' + input2).val('');
		                var reponse = "Mot de passe modifié !";
		                var ajaxReturn = new ajaxVars(data, reponse);
		            	ajaxReturn.ajaxResponse();                 
		                break;

		                case "recover": 					// send recover mail
		                window.location.href = "/projet_4/index.php?adminaction=recovercode";
		                break;

		                case "recoverCodePage":  			// redirect to new password page 
		            	window.location.href = "/projet_4/index.php?adminaction=newpasswordpage";
		            	break;

		                case "recoverPassword":             // update admin password 
		                window.location.href = "/projet_4/index.php?adminaction=admin";
		                break;

		            } 

		        }

		        /**
		        *	Get max id in bdd to create a row in admin table 
		        **/
		        else if($.isNumeric(data)) { 
		          											 
	                var reponse = "Identifiants enregistrés !";
	                var ajaxReturn = new ajaxVars("success", reponse);
	            	ajaxReturn.ajaxResponse();
	            	$('tbody').prepend('<tr id="delete-admin' + data + '"><th class="info-table"><a href="index.php?adminaction=updateadmin&id=' + data + '" class="modifier">' + $('#' + input1).val() + '</a></th><td class="info-table">' + $('#' + input3).val() + '</td><td class="info-table"><div class="column-item"><div class="container-actions"><a class="modifier" href="index.php?adminaction=updateadmin&amp;id=' + data + '">Modifier</a><a class="supprimer AdminJS2 deleteArticle" id="suppressAdminButton' + data + '" href="index.php?adminaction=deleteadmin&amp;id=' + data + '">Supprimer<span id="' + data + '"></span></a></div></div></td></tr>');
	                $('#' + input1).val('');
	                $('#' + input2).val('');
	                $('#' + input3).val(''); 

	                /**
				 	*	Delete row 
				 	**/
	                $('.AdminJS2').click(function(e) {

						e.preventDefault();

						var adminId = $(this).attr('id');						    // get button id 
						var classAdmin = $('#' + adminId + ' span').attr('id');		// get button class

						$.ajax({

							url: $('#' + adminId).attr('href'),
							type: 'GET',
							dataType: 'text',

							success: function() {

								$('#delete-admin' + data).fadeOut('slow');			// row disapear
							
							}

						});

					});
	            } 

		      },

		      'text'
		   );

		}

	}


});