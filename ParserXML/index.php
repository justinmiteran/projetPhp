<?php

//chargement config
require_once(__DIR__.'/config/config.php');
//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();

$modeleRSS = new ModeleRSS();
$modeleNews = new ModeleNews();

$fluxRSS = $modeleRSS->getRSS();

$modeleNews->netoyerBase();

foreach($fluxRSS as $rss){
    $xml = simplexml_load_file($rss->get_url());
    foreach($xml->channel->item as $item){
        try{
            $item = Validation::itemRSS($item);
            $item->set_categorie($rss->get_categorie());
            if($modeleNews->findNews($item->get_site())==0)
                $modeleNews->ajouterNews($item);
        }catch(Exception $e){
            echo("flux ".$rss->get_idRss()." : ".$rss->get_site()." - erreur : $e <br>");
        }
    }
}
echo("fini");
