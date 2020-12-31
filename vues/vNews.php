<!-- en tête page html -->
<html>
	<head>
		<meta charset="UTF-8">
		<title>News Page <?=$pageCourante?> </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="vues/css/bootstrap.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="vues/css/styleNews.css" media="screen" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="bordure">kfqsjfq</div>
		<div class="container-fluid ban bordure">
			<div class="d-flex justify-content-between">
				<div class="p-0">
					<a href="index.php">
                        <img src="vues/img/logo.png" class="img">
                    </a>
				</div>
				<div class="p-0">
					<?php
						if(isset($con) && $con == false){
							echo('<button onclick="window.location.href = \'index.php?action=formulaireConnexion\';">Connexion</button>');
						} else {
							echo('
							<div class="container">
								<div class="dropdown">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
										<div class=\"cont\"><h2 class="nom">'.$nom.'</h2></div>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="#">Ajout News</a>
										<a class="dropdown-item" href="#">Fluxs RSS</a>
										
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
<?php
// boucle for pour afficher les news
foreach($Tnews as $news){
?>
	<!-- affichage d'une news -->
	<div>
		<p><?=$news->get_heure()->format("D d M Y -- H:i")?></p>
		<img src="<?=$news->get_image()?>">
		<a href="<?=$news->get_site()?>"><?=$news->get_titre()?></a>
		<p><?=$news->get_description()?></p>
		<p><?=$news->get_categorie()?></p>
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