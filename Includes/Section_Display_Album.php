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
				$TelechargerAlbum = $Protect_rep . 'Telechargement.php?Annee='. $YearDisplay .'&Album='. $Album_No_Space  ;
				$display_Exit_Photo = $ZonePublic_rep . 'albums.php?Annee=' . $YearDisplay  ;	
				echo '<div id="Titre_Album">';
				echo '<p> Cliquez sur une photo avec le bouton gauche de la souris pour passer en diaporama, agrandir ou télécharger la photo. </p>'; 
				echo '<p> Cliquez sur l\'icon Télécharger pour télécharger l\'album complet. </p>'; 
				echo '<H3> Année '. $YearDisplay . ' ' . $Album . '. </H3>'; 
				echo '</div>';
				echo '<div id="Exit_Album">';
				echo '<a href="'. $TelechargerAlbum .'">      <img src="' . $image_rep .'telecharger-96.png" title="Télécharger album" alt="Télécharger album"></a>';
				echo '<a href="'. $display_Exit_Photo .'">    <img src="' . $image_rep .'fleche-retour-rouge.png" title="Retour Affichage liste albums" alt="Retour affichages albums"></a>';
				echo '</div>';

				echo '<div id="Affichage_Album">';
				// Recuperation de la liste des photos du repertoire photos et affichage des vignettes en lien vers la photo en taille originale
				$ListePhotos = scandir($Albums_rep . $YearDisplay . '/' . $Album . '/photos');
				$Num_Photo=0;
				foreach ($ListePhotos as $entryPhotos){
					if ($entryPhotos != "." && $entryPhotos != "..") {
						$vignette = $Albums_rep . $YearDisplay . '/'. $Album . '/vignettes/tn_' . $entryPhotos;
						//$photos   = $YearDisplay . '/'. $Album . '/photos/' . $entryPhotos;
						$display_Photo = $ZonePublic_rep . 'display_photos.php?Photo='. $Num_Photo .'&Annee='. $YearDisplay .'&Album='. $Album_No_Space  ;
						echo '<div class="Vignette_Album">';
						echo '<a href="'. $display_Photo .'" class="Choix_Photos"> <img src="' . $vignette .'" alt="'. $vignette. '"> </a>';
						echo '</div>';
		}					
					$Num_Photo++;				
				}
				echo '</div>';				
		?>			  			
	</section>
