<?php
Class News {
    // attribut d'une news
    protected $id;
    protected $heure;
    protected $site;
    protected $titre;
    protected $description;
    protected $categorie;
    protected $image;

    // constructeur d'une news
    function __construct(int $id,DateTime $heure, string $site,string $titre, string $description, string $categorie, string $image) {
        $this->id=$id;
        $this->heure=$heure;
        $this->site=$site;
        $this->titre=$titre;
        $this->description=$description;
        $this->categorie=$categorie;
        $this->image=$image;
    }
    // tostring de la news pour test
    function __tostring()
    {
        return "$this->id / "+$this->heure->format(DateTime::ISO8601)+" : $this->titre, $this->description par $this->site\n catégorie : $this->categorie\n image : $this->image";
    }

    // setter des attributs d'une news
    function set_categorie($categorie) {$this->categorie=$categorie;}
    // getter des attributs d'une news
    function get_id() {return $this->id;}
    function get_heure() {return $this->heure;}
    function get_site() {return $this->site;}
    function get_titre() {return $this->titre;}
    function get_description() {return $this->description;}
    function get_categorie() {return $this->categorie;}
    function get_image() {return $this->image;}
}