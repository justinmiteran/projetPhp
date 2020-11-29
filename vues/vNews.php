<html>
	<head>
		<title>News Page <?php echo("$pageCourante")?> </title>
	</head>
	<body>
<?php
foreach($Tnews as $news){
?>
	<div>
		<p><?php echo $news->get_heure() ?></p>
		<a href="<?php echo $news->get_titre() ?>"><?php echo $news->get_titre() ?></a>
	</div>

<?php
}


// si la page courante est superieur a la page 1
if($pageCourante > 1){
	// affiche le lien vers la page précédente et la première page
	echo('<a href="../controleur/Controleur.php?&page=1">1</a> ');
    echo('<a href="../controleur/Controleur.php?&page='.($pageCourante-1).'">&#60;&#60;</a>');
}
// affiche la page courante
echo(" $pageCourante ");

// si la page courante est inferieur au nombre de pages
if($pageCourante < $pageMax){
	// affiche le lien vers la page suivante et la dernière page
	echo('<a href="../controleur/Controleur.php?&page='.($pageCourante+1).'">&#62;&#62;</a>');
	echo(' <a href="../controleur/Controleur.php?&page='.($pageMax).'">'.$pageMax.'</a>');
}
?>
	</body>
</html>