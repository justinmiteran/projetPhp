<?php
Class Admin {
    // attribut d'une news
    protected $nom;
    protected $id


    // constructeur d'une news
    function __construct(string $nom,int $id) {
        $this->nom=$nom;
        $this->id=$id;
    }
    
    // tostring de la news pour test
    function __tostring()
    {
        return "$this->id : $this->nom";
    }

    // getter des attributs d'une news
    function get_id() {return $this->id;}
    function get_nom() {return $this->nom;}
}