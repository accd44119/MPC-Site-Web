	<section>
		<?php
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
			//$TelechargerAlbum = $Protect_rep . 'Telechargement.php?Annee='. $YearDisplay .'&Album='. $Album_No_Space  ;
			$display_Exit_Photo = $ZonePublic_rep . 'albums.php?Annee=' . $YearDisplay  ;	
			echo '<div id="Titre_Telechargement">';
			echo '<h2> Telechargement album Année '. $YearDisplay . ' ' . $Album . '. </h2>';
			$RepertoirePhotos = $Albums_rep . $YearDisplay . '/' . $Album . '/photos';
			$FichierListePhotos = $RepertoirePhotos .'/ListePhotos.txt';
			$Url = 'http://' . $_SERVER['HTTP_HOST']. substr($FichierListePhotos,2);
			// Création du fichier texte de la liste de la liste des photos du repertoire photos si il n'existe pas 
			if (file_exists($FichierListePhotos)){
				echo "<h4> La liste photos existe.</h4>";
			}
			else {
				echo "<h4> Création de la liste photos.</h4>";
				// creer fichier $FichierListePhotos
				$ListePhotos_f = fopen($FichierListePhotos, 'w');
				$ListePhotos = scandir($RepertoirePhotos);
				foreach ($ListePhotos as $entryPhotos){
					if ($entryPhotos != "." && $entryPhotos != "..") {
						fwrite($ListePhotos_f,($entryPhotos."\r\n"));
					}
				}
				fclose($ListePhotos_f); 
			}
			echo '</div>';
			echo '<div id="Telechargement" class="wrapper">';
			echo "<h3>Telechargement de l'album</h3>";
			echo '<form action="#">';
			echo '	<input type="url" value = "' . $Url. '" placeholder="Paste file url" required>';
			echo '	<button>Téléchargement Album</button>';
			//echo '	<button>Abandon</button>';
			echo '</form>';
			echo '<a href="'. $display_Exit_Photo .'">      <img src="' . $image_rep .'fleche-retour-rouge.png" title="Afficher album" alt="Afficher album"></a>';
			echo '</div>';				

			echo '<script src = "' . $Scripts_rep . 'DownloadFile.js"></script>';
		?>			  			

	</section>
