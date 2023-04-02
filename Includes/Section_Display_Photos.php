	<section>
		
		<?php
				// récupérer le numéro de la photo, l'année et le nom de l'album à afficher à partir des variables GET si elle existent
				$current = 0;					
				if(isset($_GET['Photo'])){
					$current = strip_tags($_GET['Photo']);
				}
				else{
					$current = 2;					
				}
				if(isset($_GET['Annee'])){
					$YearDisplay = strip_tags($_GET['Annee']);
				}
				else{
					$YearDisplay = "0000";					
				}
				if(isset($_GET['Album'])){
					$Album = strip_tags($_GET['Album']);
					$Album_No_Space = urlencode($Album);
				}
				else{
					$Album = "album_erreur";					
				}
				// Recuperation de la liste des photos du repertoire photos et affichage des vignettes en lien vers la photo
				$ListePhotos = scandir($Albums_rep . $YearDisplay . '/' . $Album . '/photos');
				// commande pour les control fleches suivante precedende sortie
				$display_Photo = $ZonePublic_rep . 'display_photos.php?Photo='. $current .'&Annee='. $YearDisplay .'&Album='. $Album_No_Space  ;
				$Next_Index = $current + 1;
				$Max_Index = count($ListePhotos)-1;
				if ($Next_Index > $Max_Index) { $Next_Index = 2 ;};
				$display_Next_Photo = $ZonePublic_rep . 'display_photos.php?Photo='. $Next_Index .'&Annee='. $YearDisplay .'&Album='. $Album_No_Space  ;
				$Previous_Index = $current - 1;
				if ($Previous_Index < 2) { $Previous_Index = $Max_Index ;};
				$display_Previous_Photo = $ZonePublic_rep . 'display_photos.php?Photo='. $Previous_Index .'&Annee='. $YearDisplay .'&Album='. $Album_No_Space  ;
				$display_Exit_Photo = $ZonePublic_rep . 'display_album.php?Annee='. $YearDisplay . '&Album=' . $Album_No_Space ;
				// afficher la photo courante
				$Current_Photo = $Albums_rep . $YearDisplay . '/' . $Album . '/photos/' . $ListePhotos[$current];
				echo '<div id="Titre_Photo">';
				echo '<h3> Année '. $YearDisplay . '     ' . $Album . '</h3>';
				echo '<a href="'. $display_Exit_Photo .'">      <img src="' . $image_rep .'fleche-retour-rouge.png" title="Afficher album" alt="Afficher album"></a>';
				echo '</div>';
				echo '<div id="Affichage_Photo">';
				echo '<a href="'. $display_Previous_Photo .'">  <img src="' . $image_rep .'fleche-gauche-rouge.png" title="Photo précédente" alt="Photo précédente"></a>';
				echo '<img src="' . $Current_Photo. '" alt ="' . $Current_Photo. '" >';
				echo '<a href="'. $display_Next_Photo .'">      <img src="' . $image_rep .'fleche-droite-rouge.png" title="Photo suivante" alt="Photo suivante"></a>';
				echo '</div>';
		?>			  
	</section>
