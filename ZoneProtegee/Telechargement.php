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
		<div class="wrapper">
			<h2>Telechargement d'un fichier</h2>
			<p>Collé l'url du fichier a télécharger.</p>
		  <form action="#">
			<input type="url" placeholder="Paste file url" required>
			<button>Download File</button>
		  </form>
		</div>

		<script src="DownloadFile.js"></script>

	</section>



	<?php		
		include( $Include_rep . 'Fin_Page.php');  
	?>


</html>
