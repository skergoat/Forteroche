
<?php

/**
*	REPLIES 
**/

/**
*	Create new Reply
**/
if($_GET['replyaction'] == "postreply") {

	if(isset($_GET['id']) && isset($_GET['postid']) && isset($_POST['message'])) {

		if(isset($_SESSION['admin'])) {	

			if(is_numeric($_GET['id']) && is_numeric($_GET['postid'])) {

				if($_POST['message'] == NULL) {

					echo '23.5';

				}
				else {

					if(strlen($_POST['message']) > 1000) {

						echo '22.5';
					}
					else {

						$sendReplies = $replies->storeReply($_GET['id'], $_GET['postid'], htmlspecialchars($_POST['message']));

						if($sendReplies) {

							echo $sendReplies;
						}
					}
				}
			}
			else {

				throw new \Exception('les id doivent être des nombres');
			}
		} 
		else {

			echo('error');
		}

	}
	else {

		throw new \Exception('Index inexistants');
	}
}

/**
*	Delete Replies
**/

else if($_GET['replyaction'] == "deletereply") { 

	if(isset($_SESSION['admin'])) {

		if(isset($_GET['id']) && isset($_GET['postid'])) {

			if(is_numeric($_GET['id']) && is_numeric($_GET['postid'])) {

				$deleteReply = $replies->deleteReply($_GET['id']);
			}
			else {

				throw new \Exception('les id doivent être des nombres');
			}
		}
		else {

			throw new \Exception('Il vous manque des id');
		}
	} 
	else {

		throw new \Exception('vous n\'êtes pas connecté comme admin');
	}
}