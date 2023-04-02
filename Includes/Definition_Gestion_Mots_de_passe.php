<?php
	//Nom de l'administrateur du fichier .htpasswd
	define('ADMIN_NAME', 'Admin_MPC');
	define('EMAIL_MASTER', 'motopotesclub2@free.fr');

	//Chemin du fichier .htpasswd !! depend de l'hebergement Free ou local
	if(strpos($_SERVER['SERVER_NAME'], "Free", 0))
	{
		$Hebergement_Free = true;		
		define('FILE_HTPASSWD', $Annexes_Free_rep . '.htpasswd');		
		define('FILE_HTPASSWD_SAVE', $Annexes_Free_rep . 'sauvegarde.htpasswd');		
	}
	else
	{
		$Hebergement_Free = false;		
		define('FILE_HTPASSWD', $Annexes_Local_rep . '.htpasswd');	
		define('FILE_HTPASSWD_SAVE', $Annexes_Free_rep . 'sauvegarde.htpasswd');		
	}
	
?>