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

    // fonction de récupération des news pour une page
    function supprimerNews($idNews){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new NewsGateway();       
        // récupération des news
        var_dump($gate->findNewsbyId($idNews));
        if($gate->findNewsbyId($idNews)==0) throw new Exception("L'article à supprimer n'éxiste pas");
        return $gate->sup($idNews);
    }
    
    // fonction de récupération du nombre de pages
    function ajouterNews($news){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new NewsGateway();
        // récupération du nombre max de pages
        return $gate->add($news);
    }

    function netoyerBase(){
        // initialisation de la class NewsGateway
        $gate = new NewsGateway();
        // netoyage de la base
        $gate->netBase();
    }

    function findNews($site){
        $gate = new NewsGateway();
        // netoyage de la base
        return $gate->findNews($site);
    }

}