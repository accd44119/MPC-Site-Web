	<div id="banniere_Choix">
		<?php
				// Recuperation de la liste des repertoires du dossier albums (les annéees)et affichage en lien
				$ListeYear = scandir($Albums_rep);
				echo 'Ballades... ';
				$str = "";
				foreach ($ListeYear as $entry_year)
				{				
					if(is_dir($Albums_rep . $entry_year)) 
					{
						if ($entry_year != "." && $entry_year != "..") 
						{
							$str= '<a href="'. $Maintenance_rep .'Rename_Album.php?Annee=' . $entry_year . '" class="Choix_Annee">' . $entry_year . '</a>' . $str;
							$YearDisplay = $entry_year; // init pour display du dernier repertoire si pas de choix
						}					
					}
				}
				echo $str;
		?>
	</div >
	<section>
		<div id="Liste_Albums">
			<p> Choisir une année pour renomer le nom des albums </p>
			<?php
				if(isset($_GET['Annee']))
				{
					echo '<p> Supression des espaces dans le nom des albums suivants remplacement par _: </p>';
					$YearDisplay = strip_tags($_GET['Annee']);
					// Recuperation de la liste des repertoires du dossier albums/Annee et affichage
					// On renomera tous les repertoires et fichiers des sous repertoires photos et vignettes 
					$ListeYear = scandir($Albums_rep . $YearDisplay );
					$str = "";
					$Collonne = 0;
					foreach ($ListeYear as $entry_year)
					{				
						if(is_dir( $Albums_rep . $YearDisplay . '/'. $entry_year)) {
							if ($entry_year != "." && $entry_year != "..") {
								$RepAlbumFile = $Albums_rep . $YearDisplay . '/'. $entry_year ;
								$RepAlbumFileNoSpace = strtr($RepAlbumFile," ", "_");
								if ($RepAlbumFile != $RepAlbumFileNoSpace)
								{
									echo '<p>' . $RepAlbumFile  . ' Renomer ' . $RepAlbumFileNoSpace . '</p>';
									// remommer les fichiers
									rename($RepAlbumFile,$RepAlbumFileNoSpace);
								}
							}					
						}
					}
				}
			?>			  
		</div>
	</section>
