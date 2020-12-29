<?php

class RSSGateway{
    // $con -> connexion et $tNews ->  tableau des news 
    private $con;
    private $tRSS;
    
    
    // Constructeur de la gateway
    public function __Construct(){
        global $base,$login,$mdp;
        $this->con=new Connection($base,$login,$mdp);
        $this->tRSS = [];
    }
    
    
    //Retourne toutes les news de la base de données dans le tableau tNews
    public function donnerLesRSS(){
        // Lance une commande SQL pour récupérer dans un tableau tous les éléments de la BDD triés par heure et decription 
        $this->con->executeQuery('SELECT * from TRSS',array());
        // On récupère le résultat dans un tableau $resultat
        $resultats = $this->con->getResults();
        
        // Pour toutes les valeurs de $resultat on instancie les news dans le tableau $tNews
        foreach ($resultats as $donnee){
            $this->tRSS[] = new RSS($donnee['idRSS'],$donnee['site'],$donnee['url'],$donnee['categorie']);
        }
        // On retourne le tableau
        return $this->tRSS;
    }
    
    // fonction de suppréssion de news dans la BDD
    public function supprimerRSS($id){
        // Pour une news donnée grâce à $id on la supprime via une requète SQL
        $this->con->executeQuery('DELETE from TRSS where idRSS=:id',array(':id'=>array($id, PDO::PARAM_INT)));
    }
    
    public function ajouterRSS($rss){
        // on prépare la commande sql d'insertion de news
        $query = 'INSERT into TRSS (site,url,categorie) values(:nom,:url,:categorie);';
        // on insert les variables dedans
        $this->con->executeQuery($query,array(':nom'=>array($rss->get_nom(), PDO::PARAM_INT),':url'=>array($rss->get_url(), PDO::PARAM_INT),':categorie'=>array($rss->get_categorie(), PDO::PARAM_INT)));
    }
}