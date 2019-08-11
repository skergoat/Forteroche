<?php

namespace Services;


class NotificationMail
{

	public function sendNotification($email, $messageTxt, $messageHtml) {

		if (!preg_match('#[a-z0-9._-]{1,10}@[a-z0-9._-]{1,10}\.[a-z]{1,3}#isU', $email)) 
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
	
		$message_txt = $messageTxt; 
		$message_html = $messageHtml; 
		
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());

		$sujet = "notification";

		$header = "From: \"skergoat.com\"<no-reply@skergoat.com>".$passage_ligne;
		$header.= "Reply-to: \"skergoat.com\" <no-reply@skergoat.com>".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
		 
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		 
		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;

		$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
		 
		$message.= $passage_ligne."--".$boundary.$passage_ligne;
		
		mail($email,$sujet,$message,$header);

		return true;

	}

}