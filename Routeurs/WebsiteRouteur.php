<?php 

require_once('Services/notificationMail.php');

use Services\NotificationMail;


/**
*	Website routeur 
**/

if($_GET['websiteaction'] == 'biographie') {

	require('view/Front/website/Biographie.php');			// bio 
}

else if($_GET['websiteaction'] == 'publications') {

	require('view/Front/website/Publications.php');			// publications 

}

else if($_GET['websiteaction'] == 'contact') {

	require('view/Front/website/Contact.php');				// contact 

}

else if($_GET['websiteaction'] == 'sendmail') {				// send mail

	if(isset($_POST['username']) && isset($_POST['usermail']) && isset($_POST['usermessage'])) {

		if($_POST['username'] == NULL || $_POST['usermail'] == NULL || $_POST['usermessage'] == NULL) {

			echo 'empty';									// not empty 

		}
		else {

			if(preg_match('#[a-z0-9._-]{1,20}@[a-z0-9._-]{1,20}\.[a-z]{1,3}#isU', $_POST['usermail'])) {

				if(strlen($_POST['usermessage']) > 1000) {

					echo 'tooMuch';							// message is too long 

				}
				else {

					// Ma clé privée
						$secret = "6LcQlYgUAAAAALb6uE4H8viBOe4l4qkTF2a4yCUp";
						// Paramètre renvoyé par le recaptcha
						$response = $_POST['g-recaptcha-response'];
						// On récupère l'IP de l'utilisateur
						$remoteip = $_SERVER['REMOTE_ADDR'];

					if($response == NULL || empty($response)) {

						echo 'capchaEmpty';
					}
					else {

						$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
						    . $secret
						    . "&response=" . $response
						    . "&remoteip=" . $remoteip ;

						$decode = json_decode(file_get_contents($api_url), true);
		
						if ($decode['success'] == true) {


							$MailClass = new NotificationMail;		// send mail

							$email = 'kergoane@gmail.com';

							$messageTxt = $_POST['usermessage'];
							$messageHtml = "<html><head></head><body style='font-size:15px;'> <strong>Auteur :</strong> " . $_POST['username'] . " <br/><br/> <strong>mail : </strong> " . $_POST['usermail'] . "<br/><br/> <strong>message :</strong> " . $_POST['usermessage'] . " </body></html>";

							$sendMail = $MailClass->sendNotification($email, $messageTxt, $messageHtml);

						}
						else {

							echo 'capchaError';
						}

					}
				}

			}
			else {

				echo 'invalidEmail';
			}

		}

	}
	else {

		throw new \Exception('index inexistants');
	}

}






