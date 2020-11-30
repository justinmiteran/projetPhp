<?php
Class ModeleAdmin {

    function __construct() {
    }

    // fonction de récupération des news pour une page
    function supprimerNews($idNews){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new NewsGateway();       
        // récupération des news
        return $gate->sup($idNews);
    }

    // fonction de récupération du nombre de pages
    function ajouterNews($news){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new NewsGateway();
        // récupération du nombre max de pages
        return $gate->add($news);
    }
}