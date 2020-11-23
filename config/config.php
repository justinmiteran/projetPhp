<?php

// liste des modules � inclure

$dConfig['includes']=array('Validation.php');

//BD

$base="mysql:host=localhost;dbname=projetphp";
$login="root";
$mdp="";

//Vues
$vues['erreur']=array('url'=>'erreur.php');
$vues['vnews']=array('url'=>'vnews.php');

//Controllers
$cont['contuser']=array('url'=>'Controleur.php');
