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
			echo "<p> creation d'une archive avecc les fichiers de l'album 0000/album_erreur/photos/.</p>";

			// Chemin des fichiers à ajouter dans l'archive
			$RepFile=$Albums_rep . '0000/album_erreur/photos/';
			$files_to_zip = array( $RepFile . 'xxxxxx1.jpg', $RepFile . 'xxxxxx2.jpg');

			// Nom de l'archive à créer
			$zipname = $Upload_rep . 'album_erreur_archive.zip';

			// Créer une nouvelle archive
			echo "<p> Creation et ouverture de l'archive" . $zipname . ".</p>";
			$zip = zip_open($zipname, ZIPARCHIVE::CREATE);
			if($zip)
			{
				echo "<p> l'archive" . $zipname . " est ouverte OK.</p>";
				// Parcourir la liste des fichiers à ajouter
				foreach ($files_to_zip as $file) 
				{
					echo "<p> ajout fichier ". $file ." a l'archive " . $zipname . ".</p>";
					// Ouvrir le fichier en lecture seule
					$fp = fopen($file, 'r');

					// Ajouter le fichier à l'archive
					zip_add($zip, $file, $fp);

					// Fermer le fichier
					fclose($fp);
				}

				// Fermer l'archive
				zip_close($zip);
				echo "<p> fermeture de l'archive" . $zipname . " .</p>";
			}
			else
			{
				echo "<p> l'archive" . $zipname . " n'est pas crer Erreur: ". $zip. " .</p>";
			}
			// Afficher un message de succès
			echo "<p> L'archive $zipname a été créée avec succès.</p>";

		?>
	</section>



	<?php		
		include( $Include_rep . 'Fin_Page.php');  
	?>


</html>
