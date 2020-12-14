<?php
Class Admin {
    // attribut d'une news
    protected $nom;


    // constructeur d'une news
    function __construct(string $nom) {
        $this->nom=$nom;
    }
    
    // tostring de la news pour test
    function __tostring()
    {
        return "$this->nom";
    }

    // getter des attributs d'une news
    function get_nom() {return $this->nom;}
}