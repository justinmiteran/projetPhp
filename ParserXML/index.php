<?php

//chargement config
require_once(__DIR__.'/config/config.php');
//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();

$modeleRSS = new ModeleRSS();
$modeleNews = new ModeleNews();

// récuperation des flux RSS
$fluxRSS = $modeleRSS->getRSS();

// supprime les anciennes news de la BDD
$modeleNews->netoyerBase();

//recuperqtion de chqaue flux
foreach($fluxRSS as $rss){
    // chargement du XML
    $xml = simplexml_load_file($rss->get_url());
    // recuperation de chaque items
    foreach($xml->channel->item as $item){
        try{
            // validation de l'item
            $item = Validation::itemRSS($item);
            // set de la categorie
            $item->set_categorie($rss->get_categorie());
            // test si la NEWS n'est pas deja dans la BDD
            if($modeleNews->findNews($item->get_site())==0)
                // ajout de la news
                $modeleNews->ajouterNews($item);
        }catch(Exception $e){
            echo("flux ".$rss->get_idRss()." : ".$rss->get_site()." - erreur : $e <br>");
        }
    }
}
echo("fini");
