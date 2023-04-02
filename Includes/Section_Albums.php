	<section>
		<div id="banniere_Choix">
			<?php
				// Recuperation de la liste des repertoire du dossier albums (les annéee)et affichage en lien
				$ListeYear = scandir($Albums_rep);
				echo 'Ballades...';
				$str = "";
				foreach ($ListeYear as $entry_year){				
					if(is_dir($Albums_rep . $entry_year)) {
						if ($entry_year != "." && $entry_year != "..") {
							$str= '<a href="'. $ZonePublic_rep . 'albums.php?Annee=' . $entry_year . '">' . $entry_year . '</a>' . $str;
							$YearDisplay = $entry_year; // init pour display du dernier repertoire si pas de choix
						}					
					}
				}
				echo $str;
			?>
		</div >
		<div id="Liste_Albums">
			<?php
				if(isset($_GET['Annee'])){
					$YearDisplay = $_GET['Annee'];
				}
				// Recuperation de la liste des repertoire du dossier albums/Annee et affichage en lien sur deux colonne
				// vers le php generique d'affichage d'un album display_album.php 
				echo '<div id= "Titre_Lien_Album">';
				echo '<h2>  Nos ballades ' . $YearDisplay . '</h2>'; 
				echo '</div>';
				$ListeYear = scandir($Albums_rep . $YearDisplay );
				// afichage des vignettes pv0.jpg des albums
				echo '<div id = "Liste_Lien_Album">';
				foreach ($ListeYear as $entry_year){
					if(is_dir( $Albums_rep . $YearDisplay . '/'. $entry_year)) 
					{
						if ($entry_year != "." && $entry_year != "..") 
						{
							$entry_year_No_Space = urlencode($entry_year);
							$display_album = $ZonePublic_rep . 'display_album.php?Annee='. $YearDisplay . '&Album=' . $entry_year_No_Space ;
							echo '<div class = "Lien_Album">';
							echo '<a href="'. $display_album . '" ><img src="'. $Albums_rep . $YearDisplay . '/'. $entry_year . '/vignettes/pv0.jpg" alt="Vignette pv0"></a>';
							echo '<a href="'. $display_album . '" >' . $entry_year . '</a>';
							echo '</div>';
						}					
					}
				}
				echo '</div>';
			?>			  
		</div>
	</section>
