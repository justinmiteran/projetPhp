<?php
Class ModeleNews {

    function __construct() {
    }

    function getNewsPage($page,$nbNewsPage){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new NewsGateway();         
        // récupération des news
        return $gate->donnerLesNewsPage($page,$nbNewsPage);
    }

    function getNbPages($nbNewsPage){
        $gate = new NewsGateway;
        // récupération du nombre max de pages
        return ceil($gate->nb()/$nbNewsPage);
    }
    function __tostring(){
        return "$this->heure : $this->titre, $this->description par $this->site";
    }

    function get_heure() {return $this->heure;}
    function get_site() {return $this->site;}
    function get_titre() {return $this->titre;}
    function get_description() {return $this->description;}
}