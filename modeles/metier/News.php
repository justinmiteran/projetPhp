<?php
Class News {
    // attribut d'une news
    protected $id;
    protected $heure;
    protected $site;
    protected $titre;
    protected $description;

    // constructeur d'une news
    function __construct(int $id,string $heure, string $site,string $titre, string $description) {
        $this->id=$id;
        $this->heure=$heure;
        $this->site=$site;
        $this->titre=$titre;
        $this->description=$description;
    }
    
    // tostring de la news pour test
    function __tostring()
    {
        return "$this->heure : $this->titre, $this->description par $this->site";
    }

    // getter des attributs d'une news
    function get_id() {return $this->id;}
    function get_heure() {return $this->heure;}
    function get_site() {return $this->site;}
    function get_titre() {return $this->titre;}
    function get_description() {return $this->description;}
}