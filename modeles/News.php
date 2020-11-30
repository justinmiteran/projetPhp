<?php
Class News {
    protected $heure;
    protected $site;
    protected $titre;
    protected $description;

    function __construct(string $heure, string $site,string $titre, string $description) {
        $this->heure=$heure;
        $this->site=$site;
        $this->titre=$titre;
        $this->description=$description;
    }
    
    function __tostring()
    {
        return "$this->heure : $this->titre, $this->description par $this->site";
    }

    function get_heure() {return $this->heure;}
    function get_site() {return $this->site;}
    function get_titre() {return $this->titre;}
    function get_description() {return $this->description;}
}