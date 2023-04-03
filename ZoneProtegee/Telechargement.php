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
		  <header>
			<h1>File Downloader</h1>
			<p>Paste url of image, video, or pdf to download. This tool is made with vanilla javascript.</p>
		  </header>
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
