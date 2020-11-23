<?php
require_once("NewsGateway.php");
require_once("Connection.php");
require_once("../config/config.php");


$gate = new NewsGateway(new Connection($base,$login, $mdp));

$Tnews = $gate->donnerLesNews();
$pageCourante = 1;
$pageMax =  $gate->nb()/2;
require("../vues/vNews.php");
