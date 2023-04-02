<!DOCTYPE html>
<html lang="fr">
	<?php
		$Title = "Moto Potes Club" ;
		$Level_rep = './';
		include( $Level_rep . 'Includes/Rep_Definitions.php');  
		include( $Include_rep . 'Debut_Page.php');  
	?>
          
            <div id="banniere_image">
                <div id="banniere_description">
                    Nos ballades...
                    <?php echo '<a href="' . $ZonePublic_rep . 'albums.php" class="bouton_rouge">Voir les photos <img src="'
							   . $image_rep . 'flecheblanchedroite.png" alt="" ></a>';?>
                </div>
            </div>
            
            <section>
       			<?php
					echo '<h2><img src="'. $image_rep .'ico_epingle.png" alt="Catégorie ico" class="ico_categorie" >Visiteur bienvenue</h2>';
					$actu_f = fopen($actualites, 'rb');
					$infos_f = fopen($infos_visiteurs, 'rb');
				?>
                <article>
					<h3> l'actualité</h3>
					<p class="actualite_txt"><strong>
						<?php 
							while(!feof($actu_f)){
								echo fgets($actu_f).'<br>'; 
							}
						?> 
						</strong> </p>
					<p class="actualite_signature">Corinne, Armand, Stéphane, Patrick.</p>

					<h3> informations</h3>
 					<?php 
						while(!feof($infos_f)){
							echo '<p>'.fgets($infos_f).'</p>'; 
						}
					?> 
                     <p class="info_signature">Les WebMotards Stéphane & Armand</p>
                    <p>...</p>
              </article>
				<?php
				fclose($actu_f); 
				fclose($infos_f); 
				$planing_f = fopen($planing_balades, 'rb');
				?>
                <aside>
                    <h3>Au menu cette année</h3>
 					<?php 
						while(!feof($planing_f)){
							echo '<p>'.fgets($planing_f).'</p>'; 
						}
					?> 
                    <p> <br></p>
                    <p>Pour toutes ces balades inscriptions le plus tot possible.<br></p>
                    <p> <br></p>
               </aside>
				<?php
				fclose($planing_f); 
				?>
            </section>

	<?php 
		include( $Include_rep . 'Fin_Page.php');  
	?>


</html>
