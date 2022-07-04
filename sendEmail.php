<?
// ------------------------------------------------------------ ENVOIE DE MAIL ------------------------------------------------------------

		// Envoyez le mail auto + message
		ini_set("SMTP", "MX-RELAY.FINGERPRINT.FR"); 
		ini_set("smtp_port", "587" ); 

		$mail = "tieu@gmail.com"; // Déclaration de l'adresse de destination.
		$emailemeteur = "john@doe.fr";
		$nomemeteur = "TITLE OF THE MAIL";

		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}

		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "Hello Didier, Lorem ipsum dolor sit amet, pulvinar neque. Sed porttitor nunc lectus, non eleifend arcu ultrices eu.";
		$message_html = "<html><head></head><body>Hello <b>Didier</b>,<br>
        Lorem ipsum dolor sit amet, pulvinar neque. Sed porttitor nunc lectus, non eleifend arcu ultrices eu.
		</body></html>";

		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());

		//=====Définition du sujet.
		$sujet = "SUBJECT OF THE MAIL";
		//=====Création du header de l'e-mail.
		//$header = "From: \"$nomemeteur\"<$emailemeteur>".$passage_ligne;
		//$header.= "Reply-to: \"$nomemeteur\" <$emailemeteur>".$passage_ligne;
		$header = "From: \"$nomemeteur\"<$emailemeteur>".$passage_ligne;
		$header.= "Reply-to: \"$nomemeteur\" <$emailemeteur>".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;

		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

		//=====Ajout du message au format HTML.
		$message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;

		//=====On ferme la boundary alternative.
		$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
		
	    mail($mail,$sujet,$message,$header);
        
// ------------------------------------------------------------------------------------------------------------------------
?>