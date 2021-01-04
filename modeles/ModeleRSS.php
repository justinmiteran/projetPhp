<?php
Class ModeleRSS {

    function __construct() {
    }

    // fonction de récupération des RSS
    function getRSS(){
        // initialisation de la class RSSGateway
        $gate = new RSSGateway();       
        // récupération des flux RSS
        return $gate->donnerLesRSS();
    }

    // fonction ajout RSS
    function addRSS($rss){
        // initialisation de la class RSSGateway
        $gate = new RSSGateway;
        // ajout flux
        return  $gate->ajouterRSS($rss);
    }

    // suppresion RSS
    function supRSS($idRSS){
        // initialisation de la class RSSGateway
        $gate = new RSSGateway;
        // suppression flux
        return $gate->supprimerRSS($idRSS);
    }
}