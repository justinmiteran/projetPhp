<!-- Page d'affichage des news -->
<html>
	<head>
		<meta charset="utf-8">
		<title>News Page <?=$pageCourante?> </title>
		<link rel="stylesheet" href="vues/css/bootstrap.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="vues/css/styleNews.css" media="screen" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container-fluid ban">
			<div class="d-flex justify-content-between">
				<div class="p-0">
					<a href="index.php">
                        <img src="vues/img/logo.png" class="img">
                    </a>
				</div>
				<div class="p-0 cont">
					<?php
						// Si non-connecté alors il affiche le bouton de connexion
						if(isset($con) && $con == false){
							echo('<button class="btn btn-primary menuDeroulant" onclick="window.location.href = \'index.php?action=formulaireConnexion\';">Connexion</button>');
						} else { // Sinon un bouton déroulant s'affiche avec le nom de la personne connécté
							echo('
							<div class="container">
								<div class="dropdown">
									<button type="button" class="btn btn-primary dropdown-toggle menuDeroulant" data-toggle="dropdown">
										<div class=\"cont\">'.$nom.'</div>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="index.php?action=ajouterNews">Ajout News</a>
										<a class="dropdown-item" href="index.php?action=ajouterRss">Ajout RSS</a>
										<a class="dropdown-item" href="index.php?action=afficherRss">Flux RSS</a>
										
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="index.php?action=deconnexion">Deconnexion</a>
									</div>
								</div>
					  		</div>
							');
						}
					?>
				</div>
			</div>
		</div>
		<div class="container-fluid ecart">  

		</div>
		<!-- Choix de la catégorie de news -->
		<div class="container-fluid">
		<div class="container blanco">
			<div class="dropdown">
				<button type="button" class="btn btn-primary dropdown-toggle menuDeroulant" data-toggle="dropdown">
					<div class="cont">categorie</div>
				</button>
				<div class="dropdown-menu">
				<a class="dropdown-item" href="index.php">Tous</a>
				<?php
                foreach($tCat as $cat){
                    echo('<a class="dropdown-item" href="index.php?cat='.$cat.'">'.$cat.'</a>');
                }
            	?>			
			</div>
		</div>
		<?php
			// Si un admin est connécté alors il peut choisir le nombre de news par pages
			if(isset($con) && $con == true){
				echo('
					<div class="container-fluid">
						<div class="container blanco page">
							<form class="cont" action=\'index.php?action=validerNbPages\' method=\'post\'>
								<input type="tel" placeholder="Nb pages :" name="nbPages">
								<input type="submit" id=\'submit\' value=\'Valider\'>
							</form>						
						</div>
					</div>
				');
			}
		?>
		</div>
		<?php
		// boucle for pour afficher les news
		foreach($Tnews as $news){
		?>
		<!-- affichage d'une news -->
		<div class="container-fluid">
			<div class="container blanco">
				<p><?=$news->get_heure()->format("D d M Y -- H:i")?></p>
				<?php
				if(isset($con) && $con == false){
					echo('
					<div class="cont">
						<p class="titre">'.$news->get_categorie().'</p>
					</div>
					');
				} else {
					echo('
					<div class="row justify-content-end">
						<div class="cont col">
						</div>
						<div class="cont col-6">
							<p class="titre">'.$news->get_categorie().'</p>
						</div>
						<div class="col supp2">
							<a href="index.php?action=supprimerNews&SupNews='.$news->get_id().'&page='.$pageCourante.'">
								<img class="supp" src="vues/img/supp.png">
							</a>
						</div>
					</div>
					');
				}
				?>
				<div class="bordure">
					<img class="image" src="<?=$news->get_image()?>">
				</div>
				<div class="cont">
					<a class="lien" href="<?=$news->get_site()?>"><?=$news->get_titre()?></a>
				</div>
				<p class="par"><?=$news->get_description()?></p>
			</div>
		</div>
		<?php
		}
		?>
		<!-- Navigation entre toutes les pages -->
		<div class="container-fluid fin">
			<div class="container cont">
			<?php
			// si la page courante est superieur a la page 1
			$aCat = "";
			if(isset($cat)){
				$aCat = "&cat=".$cat;
			}
			if($pageCourante > 1){
				// affiche le lien vers la page précédente et la première page
				echo('<a class="menu" href="index.php?&page=1'.$aCat.'">1</a> ');
				echo('<a class="menu" href="index.php?&page='.($pageCourante-1).$aCat.'">&#60;&#60;</a>');
			}
			// affiche la page courante
			echo(" $pageCourante ");

			// si la page courante est inferieur au nombre de pages
			if($pageCourante < $pageMax){
				// affiche le lien vers la page suivante et la dernière page
				echo('<a class="menu" href="index.php?&page='.($pageCourante+1).$aCat.'">&#62;&#62;</a>');
				echo('<a class="menu" href="index.php?&page='.($pageMax).$aCat.'">'.$pageMax.'</a>');
			}
			?>
			</div>
			
		</div>
		
	</body>
</html>