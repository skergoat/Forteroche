<?php 


if(isset($url)) {

	/**
	*	! $_GET
	**/

	if(!isset($_GET['id'])) {



		if($url == "/") {													// HOME 

			$reponse = true;
		}

		else if($url == "/projet_4/") {										// HOME 

			$reponse = true;
		}
		
		else if($url == "/projet_4/index.php") {							// HOME 

			$reponse = true;
		}

		else if(preg_match("#\/projet_4\/index\.php\?fbclid=([a-z A-Z 0-9 -])*#Usi", $url)) {	// FACEBOOK 

			$reponse = true;
		}

		


		else if($url == "/projet_4/index.php?websiteaction=biographie") {			// BIOGRAPHIE 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?websiteaction=publications") {			// PUBLICATION 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?websiteaction=contact") {				// CONTACT 

			$reponse = true;
		}

		else if($url == '/projet_4/index.php?websiteaction=sendmail') {						// SEND MAIL

			$reponse = true;
		}


		/**
		*	POSTS  
		**/

		else if($url == "/projet_4/index.php?postaction=managearticles") {				// STORE POST 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?postaction=create") {						// CREATE POST PAGE 		

			$reponse = true;
		}

		else if(isset($_GET['keyword'])) {

			if($url == "/projet_4/index.php?postaction=search&keyword=" . $_GET['keyword']) {						// SEARCH 		

				$reponse = true;
			}
			else {

				$reponse = false;
			}
		}


		/**
		*	COMMENTS  
		**/

		else if($url == "/projet_4/index.php?comaction=moderate&action=moderate") {		// MODERATE COMMENT PAGE  

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?comaction=moderate&action=reported") {		// REPORTED COMMENT PAGE 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?comaction=reply") {							// SHOW REPLY PAGE 

			$reponse = true;
		}


		/**
		*	ADMIN
		**/

		else if($url == "/projet_4/index.php?adminaction=admin") {						// SIGN IN PAGE  

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?adminaction=recover") {						// RECOVER PAGE  

			$reponse = true;
		}
//
		else if($url == "/projet_4/index.php?adminaction=postrecover") {					// SEND RECOVER CODE   

			$reponse = true;
		}
// 
		else if($url == "/projet_4/index.php?adminaction=recovercode") {					// RECOVER CODE PAGE  

			$reponse = true;
		}
// 
		else if($url == "/projet_4/index.php?adminaction=verifycode") {					// SEND AND VERIFY CODE   

			$reponse = true;
		}
// 
		else if($url == "/projet_4/index.php?adminaction=newpasswordpage") {				// RECOVER PASSWORD PAGE  

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?adminaction=authentication") {				// SIGN IN 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?adminaction=logout") {						// SIGN OUT

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?adminaction=createadmin") {					// CREATE ADMIN PAGE 

			$reponse = true;
		}
//
		else if($url == "/projet_4/index.php?adminaction=storeadmin") {					// STORE ADMIN

			$reponse = true;
		}


		/**
		*	THEMA 
		**/

		else if($url == "/projet_4/index.php?themeaction=createthema") {					// CREATE THEMA

			$reponse = true;
		}




		/**
		*	PAGINATE 
		**/

		else if(isset($_GET['paginate'])) {

			if($url == "/projet_4/index.php?paginate=" . $_GET['paginate']) {			// HOME 

				$reponse = true;
			}

			else if($url == "/projet_4/index.php?postaction=managearticles&paginate=" . $_GET['paginate']) {	

				$reponse = true;
			}
// 
			else if($url == "/projet_4/index.php?comaction=moderate&action=reported&paginate=" . $_GET['paginate']) {	
				$reponse = true;
			}
// 
			else if($url == "/projet_4/index.php?comaction=moderate&action=moderate&paginate=" . $_GET['paginate']) {

				$reponse = true;
			}

			else if($url = "/projet_4/index.php?comaction=reply&paginate=" . $_GET['paginate']) {

				$reponse = true;

			}

			else {

				$reponse = false;
			}

		}




		else {

			$reponse = false; 
		}
	}



	/**
	*	$_GET
	**/

	else if(isset($_GET['id'])) {


		// if(isset($_GET['paginate'])) {											// ADMIN POST COMMENT

		// 	if($url == "/projet_4/index.php?comaction=getcommentbypost&id=" . $_GET['id'] . "&paginate=" . $_GET['paginate']) {	

		// 		$reponse = true;
		// 	}
		// 	else {

		// 		$reponse = false; 
		// 	}
		// }


		/**
		*	POSTS  
		**/

		if($url == "/projet_4/index.php?postaction=post&id=" . $_GET['id']) {		// SINGLE POST PAGE 

			$reponse = true;
		}
//
		else if($url == "/projet_4/index.php?postaction=updatepost&id=" . $_GET['id']) { // UPDATE POST PAGE 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?postaction=update&id=" . $_GET['id']) {		// UPDATE POST 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?postaction=destroy&id=" . $_GET['id']) {	// DELETE POST 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?postaction=published&id=" . $_GET['id'] . "&action=true") {	// PUBLISHED 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?postaction=published&id=" . $_GET['id'] . "&action=false") {	// NOT PUBLISHED 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?postaction=postcomment&id=" . $_GET['id']) { 				// CREATE COMMENT 

			$reponse = true;
		}


		/**
		*	COMMENTS  
		**/				
																								// REPORT COMMENT 
		else if(isset($_GET['postid'])) {

			if($url == "/projet_4/index.php?comaction=moderate&id=" . $_GET['id'] . "&postid=" . $_GET['postid'] . "&action=report") {

				$reponse = true; 			
			}																	// DELETE COMMENT ON POST PAGE 	
			else if($url == "/projet_4/index.php?comaction=delete&id=" . $_GET['id'] . "&page=post&postid=" . $_GET['postid']) {

				$reponse = true;
			}	
 																				
			/**
			*	REPLIES 
			**/																	
// **																				// SEND REPLIES 

			else if($url = "/projet_4/index.php?replyaction=postreply&id=" . $_GET['id'] . "&postid=" .  $_GET['postid']) {

				$reponse = true;
			}									
// **																				// DELETE COMMENT ON REPLY PAGE  
			else if($url == "/projet_4/index.php?replyaction=deletereply&id=" . $_GET['id']  . "&postid=" .  $_GET['postid']) { 

				$reponse = true;
			}

													
			else {

				$reponse = false; 
			}
		}
//																				//  VALIDATE MODERATE COMMENT
		else if($url == "/projet_4/index.php?comaction=moderate&id=" . $_GET['id'] . "&action=validate&page=moderate") {

			$reponse = true;
		}
//																				//  VALIDATE REPORTED COMMENT 
		else if($url == "/projet_4/index.php?comaction=moderate&id=" . $_GET['id'] . "&action=validate&page=reported") {

			$reponse = true;
		}

//																				// DELETE MODERATE COMMENT 
		else if($url == "/projet_4/index.php?comaction=delete&id=" . $_GET['id'] . "&page=moderate") {

			$reponse = true;
		}
//																				// DELETE REPORTED COMMENT 
		else if($url == "/projet_4/index.php?comaction=delete&id=" . $_GET['id'] . "&page=reported") {

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?comaction=getcommentbypost&id=" . $_GET['id']) { // SHOW COMMENT BY POST  

			$reponse = true;
		}
		

		/**
		*	ADMIN  
		**/
																					// UPDATE ADMIN PAGE 
		else if($url == "/projet_4/index.php?adminaction=updateadmin&id=" . $_GET['id']) {

			$reponse = true;
		}
//																					// UPDATE ADMIN 
		else if($url == "/projet_4/index.php?adminaction=storeupdate&id=" . $_GET['id']) {

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?adminaction=updatepasspage&id=" . $_GET['id']) { // UPDATE PASSWORD PAGE

			$reponse = true;
		}

		else if(isset($_GET['nom'])) {												// STORE NEW PASSWORD
// 
			if($url == "/projet_4/index.php?adminaction=updatepassword&id=" . $_GET['id'] . "&nom=" . $_GET['nom']) { 

				$reponse = true;
			}
			else {

				$reponse = false;
			}
		}
																				// DELETE ADMIN
		else if($url == "/projet_4/index.php?adminaction=deleteadmin&id=" . $_GET['id']) {

			$reponse = true;
		}
//																				// SEND RECOVERED PASSWORD 
		else if($url == "/projet_4/index.php?adminaction=recoverandchangepass&id=" . $_GET['id']) { 

			$reponse = true;
		}




		/**
		*	PICTURE
		**/

		else if($url == "/projet_4/index.php?postaction=updatepicture&id=" . $_GET['id']) {		// PICTURE UPDATE 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?postaction=deletepicture&id=" . $_GET['id']) {		// PICTURE DELETE 

			$reponse = true;
		}  
		


		/**
		*	THEMA
		**/ 
//*****	Route ajax indetectable
		else if($url == "/projet_4/index.php?postaction=getindex&id=" . $_GET['id']) {			// GET THEMA INDEX 

			$reponse = true;
		}

		else if($url == "/projet_4/index.php?themeaction=themepost&id=" . $_GET['id']) {			// CREATE POST THEMA

			$reponse = true;
		}

		else if(isset($_GET['id_post'])) {
																						// DELETE THEMA  
			if($url == "/projet_4/index.php?themeaction=deletethema&id=" . $_GET['id'] . "&id_post=" . $_GET['id_post']) {

				$reponse = true;
			}
																						// THEMA WITH POST 
			// else if($url == "/projet_4/index.php?postaction=indexthema&id=" . $_GET['id']  . "&id_post=" . $_GET['id_post']) {

			// 	$reponse = true;
			// }
//*****	Route ajax indetectable 														// GET INDEX FOR POST PAGE
			else if($url == "/projet_4/index.php?postaction=getindex&id=" . $_GET['id']  . "&id_post=" . $_GET['id_post']) {			
				$reponse = true;
			}
			else {

				$reponse = false; 
			}
		}



		else {

			$reponse = false; 
		}

	}




}




