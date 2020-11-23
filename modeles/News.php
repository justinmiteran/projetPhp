<?php
Class News {
    protected $heure;
    protected $site;
    protected $titre;
    protected $description;

    function __construct(int $heure, string $site,string $titre, int $description) {
        $this->heure=$heure;
        $this->site=$site;
        $this->titre=$titre;
        $this->description=$description;
    }

    function __tostring()
    {
        return "$this->heure : $this->titre, $this->description par $this->description";
    }

    function get_heure(): int {return $this->heure;}
    function get_site(): string {return $this->site;}
    function get_titre(): string {return $this->titre;}
    function get_description(): int {return $this->description;}
}