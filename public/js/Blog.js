/**
*	This class manages blog activities :
* 	- update post
*	- publish (or not) post
*	- delete post in "managePost" page with ajax 
**/



$(function(){


	/**
	*	asynchronous request for index page
	**/
	$('.menuClick').click(function(){

		var clickId = $(this).attr('id');

		var hrefMenu = $('#' + clickId + ' span').attr('id');

		$('#menuIndex').load(hrefMenu);

	});

	/**
	*	asynchronous request for show page
	**/
	$('.showClick').click(function(){

		var clickNb = $(this).attr('id');

		var hrefShow = $('#' + clickNb + ' span').attr('id');

		$('#menuIndex').load(hrefShow);

	});


	/**
	*	Other blog functionalities 
	**/
	$('.notification').hide(); 						// Form alert hidden by default


	$('#updatePost').submit(function(e){

		e.preventDefault();

		var blogId = 'updatePost';

		var input1 = $('.first').attr('id');
		var input2 = $('.second').attr('id');

		var blogPost = new Blog(blogId, input1, input2);

		blogPost.updatePost();

	});


	/**
	*	Publish or not 
	**/

	$('.blogJS').click(function(e) {	

		e.preventDefault();

		var blogId = $(this).attr('id');			// get button id 
		var classBlog = $(this).attr('class');		// get button class

		var input1 = null;
		var input2 = null;

		var blog = new Blog(blogId, input1, input2);

		if($(this).hasClass('public')) {			// if class is : ... we trigger an action

			blog.publish(); 
		}
		else if($(this).hasClass('deleteArticle'))  {

			blog.remove();

		}

	});

	/**
	* Add picture
	**/

	$('.pictures').submit(function(e){

		e.preventDefault();

		var form = $(this).get(0);
		var blogId = new FormData(form);// get the form data

		var input1 = $(this).attr('id');
		var input2 = $('.deletePictures span').attr('id');

		var blog = new Blog(blogId, input1, input2);
		blog.addPicture();

	});

	/**
	*	Delete picture 
	**/

	$('.deletePictures').click(function(e){

		e.preventDefault();

		var pictureDeleteId = $(this).attr('id');
		var blogId = $('#' + pictureDeleteId + ' span').attr('id');

		var input1 = pictureDeleteId;
		var input2 = null;

		var blog = new Blog(blogId, input1, input2);
		blog.deletePicture();

	});


	/**
	* Delete Article
	**/

	$('.DeletePost').click(function(e){

		e.preventDefault();

		if(confirm('Etes-vous vraiment sur de vouloir supprimer l\'article ?')) {

			$.ajax({

				type		: 'GET', 
				url			: $('.DeletePost').attr('href'), 
				dataType	: 'text',

				success:function(data) {

					window.location.href = "index.php?postaction=managearticles";
				}

			});

		}
		
	});


	class Blog{

		constructor(blogId, input1, input2) {

			this.blogId = blogId;
			this.input1 = input1;
			this.input2 = input2;

		}


		/**
		* add picture
		**/

		addPicture() {

			var input2 = this.input2;

			$.ajax({

				type		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url			: $('#' + this.input1).attr('action'), // the url where we want to POST
				data		: this.blogId, // our data object
				dataType	: 'text', // what type of data do we expect back from the server
				processData: false,
				contentType: false,

				success:function(data) {

					if(data == 'empty') {

						$('.alertPicture').show().text('veuillez envoyer une image, svp');

						setTimeout(function(){

							$('.alertPicture').hide();

						}, 1000);

					}
					else if(data == 'error') {

						window.location.href = "index.php?adminaction=logout";

					}
					else if(data == 'invalid-name') {

						$('.alertPicture').show().text('Nom du fichier Invalide');

						setTimeout(function(){

							$('.alertPicture').hide();

						}, 1000);

					}
					else if(data == 'non-autorized') {

						$('.alertPicture').show().text('Fichier Invalide');

						setTimeout(function(){

							$('.alertPicture').hide();

						}, 1000);

					}
					else {

						$('#illustrate' + input2).html('<img src="' + data + '" alt="Placeholder image">');
						$('#monfichier').val('');	
					}
					
				}

			});

		}


		/**
		* Delete picture
		**/

		deletePicture() {

			var spanDelete = this.blogId;

			$.ajax({

				type		: 'GET', // define the type of HTTP verb we want to use (POST for our form)
				url			: $('#' + this.input1).attr('href'), // the url where we want to POST
				dataType	: 'text', // what type of data do we expect back from the server

				success:function(data) {

						$('#illustrate' + spanDelete).html('<img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">');
				}

			});

		}


		/**
		*	If article is deleted
		**/

		remove() {

			var blogId = this.blogId;

			$.ajax({

				url: $('#' + blogId).attr('href'),
				type: 'GET',
				dataType: 'text',

				success: function(data) {

					if(data == 'failed') {

						window.location.href = "/index.php?adminaction=logout";  
					}
					else {

						$('#tr' + blogId).fadeOut('slow');
					}
					
				}

			});
		}


		/**
		*	If article is published or not 
		**/

		publish() {

			var blogId = this.blogId;

			$.ajax({

				url: $('#' + blogId).attr('href'),
				type: 'GET',
				dataType: 'text',

				success: function(data) {	

					var idPublished = $('#id').val();

					if($('#' + blogId).hasClass('is-danger')) {

						$('#' + blogId).removeClass('is-danger').addClass('is-success').html('<strong>Publier</strong>').attr('href', 'index.php?postaction=published&id=' + idPublished + '&action=true');
					}

					else if($('#' + blogId).hasClass('is-success')) {

						$('#' + blogId).removeClass('is-success').addClass('is-danger').html('<strong>Suspendre la Publication</strong>').attr('href', 'index.php?postaction=published&id=' + idPublished + '&action=false');
					}
				}
			});
		}

		/**
		*	update post 
		**/
		updatePost() {																	

			$.post(											

			      $('#' + this.blogId).attr('action'), 
			      {
			          title: $('#' + this.input1).val(),
			          content: $('#' + this.input2).val(),  
			      },

			      function(data){

			      	if(data == 'success') {

			      		$('#form-admin').css('display', 'block'); 
				         			
				        $('.first').removeClass('is-danger');							// when inputs have class "is-danger"
			         	$('.second').removeClass('is-danger');

			            $('.notification-success').fadeIn(); 							// show success alert 
				        $('.notification-success').text("Modifications enregistrées !");

			           	setTimeout(function() {											// hide success alert 

				          $('.notification-success').hide();

				        }, 2000);
			      	}

			      	else if(data == 'failed' || data == 'error') { 						// admin is not valid anymore 

			        	window.location.href = "/projet_4/index.php?adminaction=logout";  	
			        }

			      }, 
				
				'text', 
		    );
		}
	}

});
			

