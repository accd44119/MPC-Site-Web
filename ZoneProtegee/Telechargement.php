<!DOCTYPE html>
<html  lang="fr">

	<?php
		$Title = "Telechargement" ;
		$Level_rep = '../';
		include( $Level_rep . 'Includes/Rep_Definitions.php');  
		include( $Include_rep . 'Debut_Page.php'); 
		//include( $Include_rep . 'Definition_Telechargement.php');  
		//include( $Include_rep . 'Fonction_Telechargement.php');  
		//include( $Include_rep . 'Section_Telechargement.php');
	?>
	<?php
	// definition pour le telechargement

	?>
	<?php
	// fonction pour le telechargement
	?>

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
			$Url = $ZonePublic_rep . $YearDisplay . '/' . $Album . '/photos';
			echo '<div id="Titre_Telechargement">';
			echo '<h2> Telechargement album Année '. $YearDisplay . ' ' . $Album . '. </h2>';
			//echo '<a href="'. $TelechargerAlbum .'"> TELECHARGEMENT Album    </a>';
			//echo '</div>';
			//echo '<div id="Exit_Telechargement">';
			echo '<a href="'. $display_Exit_Photo .'">      <img src="' . $image_rep .'fleche-retour-rouge.png" title="Afficher album" alt="Afficher album"></a>';
			echo '</div>';
			echo '<div id="Telechargement" class="wrapper">';
			// Recuperation de la liste des photos du repertoire photos
			//$ListePhotos = scandir($Albums_rep . $YearDisplay . '/' . $Album . '/photos');
			//$Num_Photo=0;
			//foreach ($ListePhotos as $entryPhotos){
				//if ($entryPhotos != "." && $entryPhotos != "..") {
					//$vignette = $Albums_rep . $YearDisplay . '/'. $Album . '/vignettes/tn_' . $entryPhotos;
					//$photos   = $YearDisplay . '/'. $Album . '/photos/' . $entryPhotos;
					//$display_Photo = $ZonePublic_rep . 'display_photos.php?Photo='. $Num_Photo .'&Annee='. $YearDisplay .'&Album='. $Album_No_Space  ;
					//echo '<div class="Vignette_Album">';
					//echo '<a href="'. $display_Photo .'" class="Choix_Photos"> <img src="' . $vignette .'" alt="'. $vignette. '"> </a>';
					//echo '</div>';
					//}					
					//$Num_Photo++;				
				//}			  			
			echo "<h3>Telechargement de l'album</h3>";
			echo '<form action="#">';
			echo '	<input type="url" value = "' . $Url. '" placeholder="Paste file url" required>';
			echo '	<button>Téléchargement Album</button>';
			//echo '	<button>Abandon</button>';
			echo '</form>';
			echo '</div>';				
		?>			  			

		<script src="DownloadFile.js"></script>

	</section>



	<?php		
		include( $Include_rep . 'Fin_Page.php');  
	?>


</html>
