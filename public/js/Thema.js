 /**
 *	Manages thema functions : 
 *  - create thema 
 *  - connect thema with a post 
 *  - delete thema 
 **/


$(function(){		

 	/**
 	*	select automatically "aucun theme" button when no thema selected
 	**/

    function checked() {

    	var check = $('#essai').text();
    	var test = $('#theme' + check).prop('checked', true);
    }

    checked();

    /**
    *	Manage Thema Forms
    **/


    $('.deleteThema').click(function(e){

    	e.preventDefault(); 

        var themaId = $(this).attr('id');                                          

        var idSuppr = $('#' + themaId + ' span').attr('id'); 

        if($('#theme' + idSuppr).prop('checked')) {

            $('#theme' + idSuppr).prop('checked', false)
            $('#theme0').prop('checked', true);
        }

    	inputA = null;
    	inputB = null;
    	inputC = null;

    	var themaDelete = new Thema(themaId, idSuppr, inputA, inputB, inputC);		
    	themaDelete.ajaxGet();

    });


 $('.manageThema').submit(function(e){

    	e.preventDefault();

    	var themaId = $(this).attr('id');								// send form id 
        var number = null;

    	switch(themaId) {

    		case "createThema":
    		var inputA = $('#thema');									// send input id 
    		var inputB = $('#id');
    		break;

    		case "giveThema":
    		var inputC = $(':checked').attr('id');
    		break;
    	}

    	var themaSend = new Thema(themaId, number, inputA, inputB, inputC);

    	switch(themaId) {

    		case "createThema":
    		themaSend.ajaxThema();										// call wright function 
    		break;

    		case "giveThema":
    		themaSend.ajaxThema2();
    		break;

    	}

    });


    class Thema {

    	constructor(themaId, idSuppr, inputA, inputB, inputC) {

    		this.themaId = themaId;
            this.idSuppr = idSuppr;
    		this.inputA = inputA;
    		this.inputB = inputB;
    		this.inputC = inputC; 
    	}

    	/**
    	*	Made several functions to manage several forms on the same page 
    	**/

    	/**
    	*	Manage the "Créer un thème" Form and create a new thema in the "Attribuer un thème" card   
    	**/
    	ajaxThema() {

    		var inputA = this.inputA;

			$.post(

				$('#' + this.themaId).attr('action'), 
				{  
					thema: this.inputA.val(),
					id: this.inputB.val(),
				},

				function(data){

                    if(data == 'error') {                               // if not connected, redirect to log in page 

                        window.location.href = "index.php?adminaction=admin";

                    }
                    else {

						var currentPostId = $('#id').val();				// get post id to create the "delete" link  		

						var value = inputA.val();						// get the value of the new thema from the "Créer un thème" form 

																		// create a new thema in JS which can be checked and deleted  
						if(value != 0) {

							$('#controlThema').append('<label class="radio" id="unchecked' + data + '"><a class="delete deleteThema" style="margin-right:4px;" id="deleteThema' + data + '" href="index.php?themeaction=deletethema&amp;id=' + data + '&amp;id_post=' + currentPostId + '"><span id="' + data + '"></span></a><input type="radio" style="margin-right:4px;" name="theme" value="' + data + '" id="theme' + data + '">' + value + '</label><br id="testBr' + data + '"/>');	

						}

						inputA.val('');									// empty the input

                                                                        // if delete action happens vwhen page IS NOT reloaded

						$('.deleteThema').click(function(e){

							e.preventDefault();

                            var themaId = $(this).attr('id');                                          

                            var idSuppr = $('#' + themaId + ' span').attr('id'); 

                            if($('#theme' + idSuppr).prop('checked')) {

                                $('#theme' + idSuppr).prop('checked', false)
                                $('#theme0').prop('checked', true);
                            }	

					    	$.ajax({

					    		url: $('#' + themaId).attr('href'),
					    		type: 'GET',
					    		dataType: 'text',

					    		success: function() {

					    			$('#unchecked' + idSuppr).fadeOut('slow');
                                    $('#testBr' + idSuppr).fadeOut('slow');                // delete <br> tag

					    		}

					    	});

					    });
                    }

				},
				'text',
			);
    	}

    	/**
    	*	connect thema and post 
    	**/
    	ajaxThema2() {

			$.post(

				$('#' + this.themaId).attr('action'), 
				{  
					theme: $('#' + this.inputC).val(),
				},

				function(data){

                    if(data == 'failed') {

                        window.location.href = "index.php?adminaction=admin";
                    }
                    else {

                        $('.themaSuccess').show().text('Thème attribué');

                        setTimeout(function(){

                            $('.themaSuccess').hide();

                        }, 1000);

                    }

				},
				'text',
			);
    	}

    	/**
    	*	delete existing themas 
    	**/
    	ajaxGet() {

    		var themaId = this.themaId;
            var idSuppr = this.idSuppr;

    		$.ajax({

	    		url: $('#' + this.themaId).attr('href'),
	    		type: 'GET',
	    		dataType: 'text',

	    		success: function(data) {
                                               // if delete action happens vwhen page is reloaded

                        $('#unchecked' + idSuppr).fadeOut('slow');
                        $('#testBr' + idSuppr).fadeOut('slow');             // delete <br> tag  
	    		}

	    	});
    	}
    }

});