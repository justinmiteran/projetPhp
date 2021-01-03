<!-- Affiche la liste des flux  RSS -->
<html>
	<head>
		<meta charset="utf-8">
		<title>News Page <?=$pageCourante?> </title>
		<link rel="stylesheet" href="vues/css/bootstrap.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="vues/css/styleListeFlux.css" media="screen" type="text/css" />
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
						if(isset($con) && $con == false){
							echo('<button class="btn btn-primary menuDeroulant" onclick="window.location.href = \'index.php?action=formulaireConnexion\';">Connexion</button>');
						} else {
							echo('
							<div class="container">
								<div class="dropdown">
									<button type="button" class="btn btn-primary dropdown-toggle menuDeroulant" data-toggle="dropdown">
										<div class=\"cont\">'.$nom.'</div>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="index.php?action=ajouterNews">Ajout News</a>
										<a class="dropdown-item" href="index.php?action=ajouterRss">Ajout RSS</a>
										<a class="dropdown-item" href="index.php">News</a>
										
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
        <div class="container-fluid">
			<div class="container blanco">
                <?php
                // boucle for pour afficher les flux RSS
                foreach($Trss as $rss){
                ?>
                <!-- affichage dun flux RSS -->
		
				
				<?php
				if(isset($con) && $con == false){
					echo('
					<div class="cont">
						<p class="titre">'.$rss->get_categorie().'</p>
					</div>
					');
				} else {
					echo('
					<div class="row justify-content-end">
						<div class="cont col">
							<p>'.$rss->get_site().'</p>
						</div>
						<div class="cont col-6">
							<p>'.$rss->get_categorie().'</p>
						</div>
						<div class="col supp2">
							<a href="index.php?action=supprimerRss&SupRss='.$rss->get_idRss().'">
								<img class="supp" src="vues/img/supp.png">
							</a>
						</div>
					</div>
					');
				}
			}
				?>
				
			</div>
		</div>
		<?php

		?>
	</body>
</html>