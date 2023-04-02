            <div id="banniere_image">
                <div id="banniere_description">
                    Nos ballades...
                    <?php echo '<a href="' . $Albums_rep . 'albums.php" class="bouton_rouge">Voir les photos <img src="' 
							   .$image_rep. 'flecheblanchedroite.png" alt="Fleche_droite" /></a>';?>
                </div>
            </div>
           
            <section>
                <article>
                    <?php 
						echo '<h1><img src="' . $image_rep. 'ico_epingle.png" alt="Epingle ico" class="ico_categorie" />Visiteur bienvenue</h1>';
						echo '<h2> Maintenance</h2>';
						echo '<p> =======================================================</p>';
						echo '<p> Valeurs de la variable $server </p>';
						echo '<p> $server DOCUMENT_ROOT '. $_SERVER['DOCUMENT_ROOT'] .' => Repertoire de base du serveur HTTP </p>'; 
						echo '<p> $server SERVER_NAME '. $_SERVER['SERVER_NAME'] .' => Nom serveur </p>'; 
						echo '<p> $server SERVER_ADMIN '. $_SERVER['SERVER_ADMIN'] .' => Administrateur du server </p>'; 
						echo '<p> $server HTTP_HOST '. $_SERVER['HTTP_HOST'] .'</p>'; 
						echo '<p> $server REQUEST_URI '. $_SERVER['REQUEST_URI'] .'</p>'; 
						echo '<p> $server REMOTE_USER '. $_SERVER['REMOTE_USER'] .'</p>'; 
						echo '<p> $server HTTP_REFERER '. $_SERVER['HTTP_REFERER'] .'</p>'; 
						echo '<p> $server HTTP_USER_AGENT '. $_SERVER['HTTP_USER_AGENT'] .'</p>'; 
						echo '<p> $server REMOTE_ADDR '. $_SERVER['REMOTE_ADDR'] .'</p>'; 
						echo '<p> =======================================================</p>';
						echo '<p> info sur PHP </p>';
						phpinfo();						
						echo '<p> =======================================================</p>';
					?>
                    <p class="signature">Les WebMotards Stéphane & Armand</p>
                    <p></p>
              </article>
                <aside>
                    <h2>choisir une commandes</h2>
					<table>
						<tbody>
							<tr><td><a href="./Rename_Album.php"> Remomer Albums Supression Espaces</a></td></tr>
							<tr><td><a href="../Telechargement.php"> essais download</a></td></tr>
							<tr><td><a href="../Upload.php"> essais upload</a></td></tr>
							<tr><td><a href="./Gestion_Mots_de_passe.php"> Gestion utilisateur </a></td></tr>
						</tbody>
					</table>
                    <p>--------------------------------------------- <br></p>
                    <p> <br></p>
               </aside>
            </section>
