<?php
Class RSS {
    // attribut d'une news
    protected $nom;
    protected $url;

    // constructeur d'une news
    function __construct(string $nom, string $url) {
        $this->nom=$nom;
        $this->url=$url;
     
    }
    
    // tostring de la news pour test
    function __tostring()
    {
        return "$this->nom : $this->url";
    }

    // getter des attributs d'une news
    function get_nom() {return $this->nom;}
    function get_url() {return $this->url;}
}