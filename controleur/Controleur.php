<?php
require_once("NewsGateway.php");
require_once("Connection.php");
require_once("Validation.php");
require_once("../config/config.php");

//variable du nombre de news par page
$nbNewsPage = 2;

// initialisation de la class NewsGateway et de la classe Validation
$gate = new NewsGateway(new Connection($base,$login, $mdp));
$val = new Validation();


// récupération du nombre max de pages
$pageMax =  ceil($gate->nb()/$nbNewsPage);
// si une page est apssé dans l'url vérifier sa valeur
if(isset($_GET['page'])) $pageCourante = $val->valPage($_GET['page'],$pageMax);
// sinon définir la page courante a 1
else $pageCourante=1;

// récupération des news
$Tnews = $gate->donnerLesNewsPage($pageCourante,$nbNewsPage);

// si il y a des erreurs de validation
if(($TErreur = $val->getErreur())) require($vues['erreur']);
// appeler la vue des News
else require($vues['vNews']);
