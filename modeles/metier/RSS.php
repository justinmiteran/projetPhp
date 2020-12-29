<?php
Class RSS {
    // attribut d'une news
    protected $site;
    protected $url;
    protected $categorie;
    protected $idRss;

    // constructeur d'une news
    function __construct(int $idRss,string $site, string $url,string $categorie) {
        $this->site=$site;
        $this->url=$url;
        $this->categorie=$categorie;
        $this->idRss=$idRss;
    }
    
    // tostring de la news pour test
    function __tostring()
    {
        return "$this->idRss - $this->site : $this->url, $this->categorie";
    }

    // getter des attributs d'une news
    function get_idRss() {return $this->idRss;}
    function get_site() {return $this->site;}
    function get_url() {return $this->url;}
    function get_categorie() {return $this->categorie;}

}