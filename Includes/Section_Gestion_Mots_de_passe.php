<?php
	// Recuperation du user loger on autorisera que l'administrateur a modifier.
	$user_logged = empty($_SERVER['REMOTE_USER']) ? 'No_User_log' : $_SERVER['REMOTE_USER'];
	$resultat = "---";

	// traitement des demandes du formulaire Creation/modification ou supression
	if (isset($_POST['login']) && isset($_POST['pass'])) {
		$login = $_POST['login'];
		$pass = $_POST['pass'];
		if (!file_exists(FILE_HTPASSWD)) { //si le fichier n'existe pas on le cree
			echo ecrire_fichier(FILE_HTPASSWD, '# Fichier des mots de passe généré avec ' . get_complete_url(false) . "\n");
		}
		$resultat  = '';
		$message = '';
		$contenu = '';
		if (isset($_POST['update'])) 
		{
			// criptage du mot de passe en local seulement sur free la version APACHE est ancienne le mot de passe ne sont pas codé
			if ($Hebergement_Free)
			{
				$pass_crypte = $pass; // On ne crypte pas le mot de passe
			}
			else
			{
				$pass_crypte = crypt_apr1_md5($pass); // On crypte le mot de passe			
			}
			if (($user_logged == ADMIN_NAME)) // Seul ADMIN_NAME peut modifié ou crer un utilisateur
			{
				if ((FILE_HTPASSWD_SAVE != '') && !copy(FILE_HTPASSWD, FILE_HTPASSWD_SAVE)) 
				{  // Sauvegarde le fichier mot de passe
					$message .= 'La copie du fichier ' . FILE_HTPASSWD . ' en ' . FILE_HTPASSWD_SAVE . " n'a pas réussi...\n";
				} 
				else 
				{
					$insere = false;
					$handle = fopen(FILE_HTPASSWD, 'r'); // Ouvre le fichier en lecture
					if ($handle) {
						while (!feof($handle)) 
						{
							$buffer = fgets($handle, 4096);
							if ((strlen($buffer) > 0) && (($pos = strpos($buffer, ':', 1)) > 0)) 
							{
								$utilisateur = substr($buffer, 0, $pos);
								if (($difference = strcmp($login, $utilisateur)) == 0) {  // User existe déjà
									if ($insere == false) {
										$contenu .= $login . ':' . $pass_crypte . "\n";
										$resultat = "Utilisateur $login modifié OK.\n";
										$message .= $resultat;
										$insere = true;
									} else {
										$message .= "Utilisateur $login présent deux fois : on supprime le deuxième.\n";
									}
								} elseif ($difference < 0) {  // Trié par ordre alphabétique
									if ($insere == false) {
										$contenu .= $login . ':' . $pass_crypte . "\n";
										$resultat = "Utilisateur $login Créé OK.\n";
										$message .= $resultat;
										$insere = true;
									}
									$contenu .= $buffer;
								} else {
									$contenu .= $buffer;
								}
							} else {
								$contenu .= $buffer;
							}
						}
						if ($insere == false) {  // Ajoute en dernière position si pas déjà ajouté
							$contenu .= $login . ':' . $pass_crypte . "\n";
							$resultat = "Utilisateur $login créé OK.\n";
							$message .= $resultat;
							$insere = true;
						}
						fclose($handle);
					} else {
						$message .= 'Erreur ouverture du fichier ' . FILE_HTPASSWD . ".\n";
					}
					$message .= ecrire_fichier(FILE_HTPASSWD, $contenu);
				}
				envoyer_mail('Modification ou creation utilisateur site MPC');
			} else {
				echo "Pas d'autorisation de modification utilisateur $login. Il faut etre administrateur.\n";
			}
		} elseif (isset($_POST['delete'])) 
		{
			if (($user_logged == ADMIN_NAME) && ($login != ADMIN_NAME)) 
			{  // Pas de suppression si pas ADMIN_NAME et pas de suppression du user ADMIN_NAME
				if ((FILE_HTPASSWD_SAVE != '') && !copy(FILE_HTPASSWD, FILE_HTPASSWD_SAVE)) 
				{  // Sauvegarde le fichier mot de passe
					$message .= "La copie du fichier " . FILE_HTPASSWD . ' en ' . FILE_HTPASSWD_SAVE . " n'a pas réussi...\n";
				} 
				else 
				{
					$supprime = false;
					$handle = fopen(FILE_HTPASSWD, 'r'); // Ouvre le fichier en lecture
					if ($handle) {
						while (!feof($handle)) {
							$buffer = fgets($handle, 4096);
							if ((strlen($buffer) > 0) && (($pos = strpos($buffer, ':', 1)) > 0)) 
							{
								$utilisateur = substr($buffer, 0, $pos);
								$pass_crypte = substr($buffer, $pos + 1);
								if ($login == $utilisateur) {  // User existe 
									if ($supprime == false) 
									{
										$resultat = "Utilisateur $login suprimé OK.\n";
										$message .= $resultat;
										$supprime = true;
									} 
									else 
									{
										$message .= "Utilisateur $login présent deux fois : On supprime aussi le deuxième aussi.\n";
									}
								} 
								else 
								{
									$contenu .= $buffer;
								}
							} 
							else 
							{
								$contenu .= $buffer;
							}
						}
						if ($supprime == false) 
						{  // Utilisateur n'existe pas
							$resultat = "L'utilisateur $login n'existe pas dans le fichier.\n";
							$message .= $resultat;
						}
						fclose($handle);
					} 
					else 
					{
						$message .= "Erreur d'ouverture du fichier " . FILE_HTPASSWD . ".\n";
					}
					$message .= ecrire_fichier(FILE_HTPASSWD, $contenu);
				}
				envoyer_mail('Suppression utilisateur du site MPC'); 
			} 
			else 
			{
				echo "Pas d'autorisation de supprimer l'utilisateur $login. il faut etre administrateur\n";
			}
		} 
		else 
		{
			die("Action \"$submit\" inconnue.\n");
		}
		//die ($resultat);
	}
	
	if ($user_logged == ADMIN_NAME) 
	{ 
		$Remote_Server = $_SERVER['REMOTE_USER'];
		echo '<p>-------------------------------------------------------- </p>';
		echo '<p>  Bonjour ' . $Remote_Server . ' </p>';
		echo '<p>-------------------------------------------------------- </p>';
		if (empty($Remote_Server)) 
		{
			echo '<p>Protégez ce script par un fichier .htpasswd!!!</p>';   
		}
		echo '<p> '  . $resultat . '</p>';
		echo '<p>-------------------------------------------------------- </p>';
		echo '<p> Gestion des utilisateurs du fichier de mot de passe ' . FILE_HTPASSWD . '</p>';
?>
		<form method="post" action="">
			<table>
				<tr>
					<td><label for="login" accesskey="L">Login</label></td>
					<td><input type="text" name="login" id="login"></td>
				</tr>
				<tr>
					<td><label for="pass" accesskey="P">Mot de passe</label></td>
					<td><input type="text" name="pass" id="pass"></td>
				</tr>
			</table>
			<table>
				<tr>
					<td><input type="submit" name="update" value="Modifier"></td>
					<td><input type="submit" name="delete" value="Supprimer" onclick="javascript:return confirm('Etes-vous sur de supprimer cet utilisateur ?');"></td>
					<td><input type="reset" name="reset" value="Annuler" onclick="javascript:history.back()"></td>
				</tr>
			</table>
		</form>
<?php 
	}
	else 
	{
		echo '<p> Gestion des utilisateurs réserver au compte administrateur du site </p>';
	}
?>
