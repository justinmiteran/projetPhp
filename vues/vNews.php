<!-- en tête page html -->
<html>
	<head>
		<title>News Page <?=$pageCourante?> </title>
		<link rel="stylesheet" href="css/bootstrap.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="css/styleNews.css" media="screen" type="text/css" />
	</head>
	<body>
		<div class="container-fluid ban">
			<div class="d-flex justify-content-between">
				<div class="p-0">
					<a href="index.php">
                        <img src="img/logo.png" class="img">
                    </a>
				</div>
				<div class="p-0">
					<?php
						if(isset($con) && $con == false){
							echo('<button onclick="window.location.href = \'index.php?action=formulaireConnexion\';">Connexion</button>');
						} else {
							echo('
								<nav>
									<ul>
										<li class="deroulant"><a class="deroulantBis" href="#">Menu</a>
											<ul class="sous_deroulant">
												<li><a class="bouton" href="#">Ajout News</a></li>
												<li><a href="#">Flux RSS</a></li>
												<li><a href="index.php?action=deconnexion">Déconnexion</a></li>
											</ul>
										</li>
									</ul>
								</nav>
							');
						}
					?>
				</div>
			</div>
		</div>
		<div class="container-fluid ecart">  

        </div>
<?php
// boucle for pour afficher les news
foreach($Tnews as $news){
?>
	<!-- affichage d'une news -->
	<div>
		<p><?=$news->get_heure()->format("D d M Y -- H:i")?></p>
		<a href="<?=$news->get_titre()?>"><?=$news->get_titre()?></a>
		<p><?=$news->get_description()?></p>
		<p><?=$news->get_site()?></p>
		<p>-------------------------------------------</p>
	</div>

<?php
}

// si la page courante est superieur a la page 1
if($pageCourante > 1){
	// affiche le lien vers la page précédente et la première page
	echo('<a href="index.php?&page=1">1</a> ');
    echo('<a href="index.php?&page='.($pageCourante-1).'">&#60;&#60;</a>');
}
// affiche la page courante
echo(" $pageCourante ");

// si la page courante est inferieur au nombre de pages
if($pageCourante < $pageMax){
	// affiche le lien vers la page suivante et la dernière page
	echo('<a href="index.php?&page='.($pageCourante+1).'">&#62;&#62;</a>');
	echo(' <a href="index.php?&page='.($pageMax).'">'.$pageMax.'</a>');
}
?>
	</body>
</html>