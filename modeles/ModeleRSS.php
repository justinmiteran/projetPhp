<?php
Class ModeleRSS {

    function __construct() {
    }

    // fonction de récupération des news pour une page
    function getRSS(){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new RSSGateway();       
        // récupération des news
        return $gate->donnerLesRSS();
    }

    // fonction de récupération du nombre de pages
    function addRSS($rss){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new RSSGateway;
        // récupération du nombre max de pages
        return  $gate->ajouterRSS($rss);
    }

    function supRSS($idRSS){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new RSSGateway;
        // récupération du nombre max de pages
        return $gate->supprimerRSS($idRSS);
    }
}