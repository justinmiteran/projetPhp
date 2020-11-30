<?php

// Gateway des News
class NewsGateway{
    // $con -> connexion et $tNews ->  tableau des news 
    private $con;
    private $tNews;
    
    
    // Constructeur de la gateway
    public function __Construct(){
        global $base,$login,$mdp;
        $this->con=new Connection($base,$login,$mdp);
        $this->tNews = [];
    }
    
    
    //Retourne toutes les news de la base de données dans le tableau tNews
    public function donnerLesNews(){
        // Lance une commande SQL pour récupérer dans un tableau tous les éléments de la BDD triés par heure et decription 
        $this->con->executeQuery('SELECT * from TNews order by heure desc',array());
        // On récupère le résultat dans un tableau $resultat
        $resultats = $this->con->getResults();
        
        // Pour toutes les valeurs de $resultat on instancie les news dans le tableau $tNews
        foreach ($resultats as $donnee){
            $this->tNews[] = new News($donnee["heure"], $donnee["site"], $donnee["nom"], $donnee["description"]);
        }
        // On retourne le tableau
        return $this->tNews;
    }

    // Donne les news par page numPage -> numéro de la page actuel et newsPage -> le nombre de news par page
    public function donnerLesNewsPage($numPage,$newsPage){
        // On prépart la commande SQL qui va nous donner les news de la page trié pat heure et description
        $query = "SELECT * from TNews order by heure desc limit :nbNews offset :debut";
        // :debut -> à partir de quelle news on commence pour récupérer les bonnes news de la page dans la BDD
        $this->con->executeQuery($query,array(':nbNews'=>array($newsPage, PDO::PARAM_INT),':debut'=>array(($numPage-1)*$newsPage, PDO::PARAM_INT)));
        
        // On récupère les résultats dans le tableau résultat
        $resultats = $this->con->getResults();
        
        // Pour chaques résultats on instancie la news dans tNews
        foreach ($resultats as $donnee){
            $this->tNews[] = new News($donnee["heure"], $donnee["site"], $donnee["nom"], $donnee["description"]);
        }
        // Et on retourne tNews
        return $this->tNews;
    }
    
    
    // Retourne le nombre de news dans la BDD 
    public function nb(){
        // récupère dans la variable NB le nombre de news
        $this->con->executeQuery('SELECT count(*) NB from TNews',array());
        // On récupère le résultat dans  $nb
        $nb = $this->con->getResults();
        // On retourne le nombre de news
        foreach ($nb as $donnee){
            return $donnee["NB"]; 
        }
    }
    
    // fonction de suppréssion de news dans la BDD
    public function sup($id){
        // Pour une news donnée grâce à $id on la supprime via une requète SQL
        $this->con->executeQuery('DELETE from TNews where idNews=:id',array());
    }
}
?>
