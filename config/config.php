<?php

//BD

$base="mysql:host=localhost;dbname=projetphp";
$login="root";
$mdp="";

//Vues
$vues['erreur']='vues/vErreur.php';
$vues['vNews']='vues/vNews.php';
$vues['vConnexion']='vues/vConnexion.html';
$vues['vDeconnexion']='vues/vDeconnexion.php';
$vues['vAjoutNews']='vues/vAjout.php';
$vues['vAjoutFlux']='vues/vAjoutFlux.php';
$vues['vListeFlux']='vues/vListeFlux.php';

//Controllers
$cont['controleurUser']='controleur/ControleurUser.php';
