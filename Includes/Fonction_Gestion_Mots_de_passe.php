<?php
	//ecrit dans un fichier
	function ecrire_fichier($nom_fichier, $contenu) {
		if (($handle = fopen($nom_fichier, 'w')) !== false) 
		{
			if (fputs($handle, $contenu, strlen($contenu)) == false) 
			{
				return 'Impossible d\'&eacute;crire "' . $contenu . '" dans le fichier (' . $nom_fichier . ").\n";
			}
			fclose($handle);
			return '';
		} 
		else 
		{
			return 'Erreur d\'ouverture du fichier ' . $nom_fichier . ".\n";
		}
	}

	//Envoyer un mail a l'administrateur
	function envoyer_mail($sujet) 
	{
		global $login, $pass, $pass_crypte, $message;
		
		$corps  = "\nuser : " . $login;
		$corps .= "\nMot de passe : " . $pass;
		$corps .= "\nLigne htpasswd : " . $login . ':' . $pass_crypte;
		if (isset($_SERVER['REMOTE_USER']))  $corps .= "\n\nRemote user : " . $_SERVER['REMOTE_USER'];
		$corps .= "\nMessage : " . $message;
		if (!empty($_SERVER['HTTP_REFERER'])) {
			$corps .= "\nProvenance : " . $_SERVER['HTTP_REFERER'];
		}
		$corps .= "\nPage : " . get_complete_url();
		if (!empty($_SERVER['HTTP_USER_AGENT'])) {
			$corps .= "\nNavigateur : " . $_SERVER['HTTP_USER_AGENT'];
		}
		$corps .= "\nAdresse IP : " . $_SERVER['REMOTE_ADDR'];
		$corps .= "\nNom de domaine : ".gethostbyaddr($_SERVER['REMOTE_ADDR']);
		mail(EMAIL_MASTER, $sujet, $corps, 'From: ' . EMAIL_MASTER);
	}

	// retourne l'url complète de la page courante (avec ou sans les paramètres)
	function get_complete_url($sansparam = false) 
	{
		if ($sansparam) {
			if (isset($_SERVER['SCRIPT_URI'])) {
				return $_SERVER['SCRIPT_URI'];
			} else {
				$uri = explode('?', $_SERVER['REQUEST_URI']);
				return 'http://' . $_SERVER['HTTP_HOST'] . $uri[0];
			}
		} else {
			if (isset($_SERVER['SCRIPT_URL']) && isset($_SERVER['REQUEST_URI']) && isset($_SERVER['SCRIPT_URI'])) {
				return str_replace($_SERVER['SCRIPT_URL'], $_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_URI']);
			} else {
				return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			}
		}
	}

	// http://fr.php.net/manual/fr/function.crypt.php#73619
	function crypt_apr1_md5($plainpasswd) {
		$tmp='';
		$salt = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);
		$len = strlen($plainpasswd);
		$text = $plainpasswd.'$apr1$'.$salt;
		$bin = pack("H32", md5($plainpasswd.$salt.$plainpasswd));
		for($i = $len; $i > 0; $i -= 16) { $text .= substr($bin, 0, min(16, $i)); }
		for($i = $len; $i > 0; $i >>= 1) { $text .= ($i & 1) ? chr(0) : $plainpasswd[0]; }
		$bin = pack("H32", md5($text));
		for($i = 0; $i < 1000; $i++) {
			$new = ($i & 1) ? $plainpasswd : $bin;
			if ($i % 3) $new .= $salt;
			if ($i % 7) $new .= $plainpasswd;
			$new .= ($i & 1) ? $bin : $plainpasswd;
			$bin = pack("H32", md5($new));
		}
		for ($i = 0; $i < 5; $i++) {
			$k = $i + 6;
			$j = $i + 12;
			if ($j == 16) $j = 5;
			$tmp = $bin[$i].$bin[$k].$bin[$j].$tmp;
		}
		$tmp = chr(0).chr(0).$bin[11].$tmp;
		$tmp = strtr(strrev(substr(base64_encode($tmp), 2)),
		"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
		"./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
		return "$"."apr1"."$".$salt."$".$tmp;
	}
?>