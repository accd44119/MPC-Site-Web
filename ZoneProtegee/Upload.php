<!DOCTYPE html>
<html  lang="fr">

	<?php
		$Title = "Upload" ;
		$Level_rep = '../';
		include( $Level_rep . 'Includes/Rep_Definitions.php');  
		include( $Include_rep . 'Debut_Page.php'); 
		//include( $Include_rep . 'Definition_Upload.php');  
		//include( $Include_rep . 'Fonction_Upload.php');  
		//include( $Include_rep . 'Section_Upload.php');
	?>
	<?php
	// definition pour le telechargement
	define('FILE_SIZE_MAX', 536870912);  // taille max des fichiers telecharger en octet 512Mo (1Mo = 1048576 octets)
	define('UPLOAD_REP', $Upload_rep); // repertoire d'upload

	?>
	<?php
	// fonction pour  l'upload de fichiers
	function FILE_UPLOADER($num_of_uploads=1, $file_types_array=array('jpg',
																	  'gif',
																	  'png',
																	  'mp3',
																	  'bmp',
																	  'swf',
																	  'flv',
																	  'mpeg',
																	  'jpeg'),
										  $max_file_size=FILE_SIZE_MAX, $upload_dir=UPLOAD_REP)
	{
		if(!is_numeric($max_file_size))
		{
			$max_file_size = FILE_SIZE_MAX;
		}
		$max_file_size_Mo = $max_file_size/1048576;
		if(!isset($_POST['submitted']))
		{
			// Construction du formulaire pour designé les fichier a uploader
			$form = '<form action="" method="post" enctype="multipart/form-data">
									Telechargement de fichier:<input type="hidden" name="submitted"' .' value="TRUE" id="'.time().'">
									<input type="hidden" name="MAX_FILE_SIZE" value="'.$max_file_size.'">';
			for($x=0;$x<$num_of_uploads;$x++)
			{
			  $form .= '<input type="file" name="file[]"><font color="red">*</font><br /><br />';
			}
			$form .= '<input type="submit" value="Telecharger"><br /><font color="red">*</font>Type(s) de fichiers autorisés: ';
			$y=count($file_types_array);
			for($x=0;$x<$y;$x++)
			{
			  if($x<$y-1)
			  {
				$form .= $file_types_array[$x].', ';
			  }
			  else
			  {
				$form .= $file_types_array[$x].'.';
			  }
			}
			$form .= '</form>';
			echo($form);
		}
		else
		{
			// Verification conformité des fichier et deplacement dans le repertoire Upload
			foreach($_FILES['file']['error'] as $key => $value)
			{
				if($_FILES['file']['name'][$key]!="")
				{
					if($value==UPLOAD_ERR_OK)
					{
						// Pas d'erreur on verifie le fichier et si ok on transfert dans rep $upload_dir
						$origfilename = $_FILES['file']['name'][$key];
						$filename = explode('.', $_FILES['file']['name'][$key]);
						$filenameext = $filename[count($filename)-1];
						unset($filename[count($filename)-1]);
						$filename = implode('.', $filename);
						$filename = substr($filename, 0, 15).'.'.$filenameext;
						$file_ext_allow = FALSE;//par mesure de securité on suppose l'extenion du fichier fausse
						//verifions si notre fichier fait partie des types autorisés
						if(false !== ($iClef = array_search($filenameext, $file_types_array))) {$file_ext_allow = TRUE;}
							if($file_ext_allow)
							{
							if($_FILES['file']['size'][$key]<$max_file_size)
								{
									if(move_uploaded_file($_FILES['file']['tmp_name'][$key], $upload_dir.$filename))
									{
										echo('Transfert de fichier effectué avec succès. -
										  <a href="'.$upload_dir.$filename.'" target="_blank">'.$filename.'</a><br />');
										  /*evidemment plutot que d'afficher ici le lien vers le fichier uploader
										  sur le serveur vous pouvez proceder à une redirection vers une autre page*/
									}
									else
									{
										echo('Une erreur est survenue lors du transfert de '.'<strong>'.$origfilename.'</strong><br />');
									}
								}
								else
								{
									echo('La taille du fichier '.''.$origfilename.''.' excède les '.$max_file_size_Mo.' Mo autorisé(s)');
								}
							}
							else
							{
								echo('Le fichier '.''.$origfilename.''.'  a une extension invalide, ERREUR DE TRANSFERT !<br />');
							}
					}
					else
					{
						$origfilename = $_FILES['file']['name'][$key];
						echo('Erreur ' . $value .' survenue sur transfert de '.'<strong>'.$origfilename.'</strong>');
					}
				}
			}
		}
	}
	?>
	
	<section>
		<?php
			FILE_UPLOADER(3,array('zip','rar'),FILE_SIZE_MAX,$Upload_rep);
			/*
				if(isset($_GET['Annee'])){
					$YearDisplay = strip_tags($_GET['Annee']);
				}
				else{
					$YearDisplay = "0000";					
				}
				if(isset($_GET['Album'])){
					$Album = strip_tags($_GET['Album']);
				}
				else{
					$Album = "album_erreur";					
				}
				$Album_No_Space = urlencode($Album);
				echo '<div id="Titre_Album">';
				echo '<H3> Essais connection FTP Année '. $YearDisplay . ' ' . $Album . '. </H3>'; 
				// connection au seveur
				$FtpSession=ftp_connect("ftpperso.free.fr",21,60);
				if ($FtpSession)
				{
					echo '<p> Connection au serveur OK </p>';
					$FtpLogin = ftp_login($FtpSession,"motopotesclub2","motoclub");
					if ($FtpLogin)
					{
						echo '<p> login au serveur OK </p>';
					}
					else
					{
						echo '<p> Pas de login au serveur KO </p>';
					}
					$FtpClose = ftp_close($FtpSession);
					if ($FtpClose)
					{
						echo '<p> close connection OK </p>';
					}
					else
					{
						echo '<p> pas de close connection KO </p>';
					}

				}
				else
				{
					echo '<p> Pas de Connection au serveur KO </p>';
				}

				echo '</div>';

			*/		
		?>
	</section>



	<?php		
		include( $Include_rep . 'Fin_Page.php');  
	?>


</html>
