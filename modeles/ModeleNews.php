<?php
Class ModeleNews {

    function __construct() {
    }

    // fonction de récupération des news pour une page
    function getNewsPage($page,$nbNewsPage){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new NewsGateway();       
        // récupération des news
        return $gate->donnerLesNewsPage($page,$nbNewsPage);
    }

    // fonction de récupération du nombre de pages
    function getNbPages($nbNewsPage){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new NewsGateway;
        // récupération du nombre max de pages
        return ceil($gate->nb()/$nbNewsPage);
    }
}