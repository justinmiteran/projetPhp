<!-- en tête page html -->
<html>
	<head>
		<title>News Page <?=$pageCourante?> </title>
	</head>
	<body>

<?php
// boucle for pour afficher les news
foreach($Tnews as $news){
?>
	<!-- affichage d'une news -->
	<div>
		<p><?=$news->get_heure()?></p>
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