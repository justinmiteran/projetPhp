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
            $this->tNews[] = new News($donnee["idNews"],new DateTime($donnee["heure"]), $donnee["site"], $donnee["nom"], $donnee["description"],$donnee["categorie"],$donnee["image"]);
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
            $this->tNews[] = new News($donnee["idNews"],new DateTime($donnee["heure"]), $donnee["site"], $donnee["nom"], $donnee["description"],$donnee["categorie"],$donnee["image"]);
        }
        // Et on retourne tNews
        return $this->tNews;
    }

    // donne les news d'une page avec catégorie
    public function donnerLesNewsPageCat($numPage,$newsPage,$cat){
        // On prépart la commande SQL qui va nous donner les news de la page trié pat heure et description
        $query = "SELECT * from TNews where categorie=:cat order by heure desc limit :nbNews offset :debut";
        // :debut -> à partir de quelle news on commence pour récupérer les bonnes news de la page dans la BDD
        $this->con->executeQuery($query,array(':cat'=>array($cat, PDO::PARAM_STR),':nbNews'=>array($newsPage, PDO::PARAM_INT),':debut'=>array(($numPage-1)*$newsPage, PDO::PARAM_INT)));
        
        // On récupère les résultats dans le tableau résultat
        $resultats = $this->con->getResults();
        
        // Pour chaques résultats on instancie la news dans tNews
        foreach ($resultats as $donnee){
            $this->tNews[] = new News($donnee["idNews"],new DateTime($donnee["heure"]), $donnee["site"], $donnee["nom"], $donnee["description"],$donnee["categorie"],$donnee["image"]);
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

    // fonction qui retourne le nombre de news par catégorie
    public function nbCat($cat){
        // récupère dans la variable NB le nombre de news
        $this->con->executeQuery('SELECT count(*) NB from TNews where categorie=:cat',array(':cat'=>array($cat, PDO::PARAM_STR)));
        // On récupère le résultat dans  $nb
        $nb = $this->con->getResults();
        // On retourne le nombre de news
        foreach ($nb as $donnee){
            return $donnee["NB"]; 
        }
    }
    
    // fonction de suppression de news dans la BDD
    public function sup($id){
        // Pour une news donnée grâce à $id on la supprime via une requète SQL
        $this->con->executeQuery('DELETE from TNews where idNews=:id',array(':id'=>array($id, PDO::PARAM_INT)));
    }

    // fonction qui ajoute la news passé en paramètre dans la base de donnée
    public function add($news){
        // on prépare la commande sql d'insertion de news
        $query = "INSERT into Tnews (heure,site,nom,description,categorie,image) values(STR_TO_DATE(:date,'%a, %d %b %Y %T'),:site,:nom,:description,:categorie,:image)";
        // on insert les variables dedans
        $this->con->executeQuery($query,array(':date'=>array($news->get_heure()->format("D, d M Y H:i:s"), PDO::PARAM_STR),':site'=>array($news->get_site(), PDO::PARAM_STR),':nom'=>array($news->get_titre(), PDO::PARAM_STR),':description'=>array($news->get_description(), PDO::PARAM_STR),':categorie'=>array($news->get_categorie(), PDO::PARAM_STR),':image'=>array($news->get_image(), PDO::PARAM_STR)));
    }

    // fonction qui retourne le nombre de news qui ont le même id que passé en paramètre
    public function findNewsbyId($id){
        $this->con->executeQuery('SELECT count(*) nb from TNews where idNews=:id',array(':id'=>array($id, PDO::PARAM_INT)));
        return $this->con->getResults()[0]["nb"];
    }

    // fonction de suppression de news dans la BDD de plus d'un mois
    public function netBase(){
        // Pour une news donnée grâce à $id on la supprime via une requète SQL
        $this->con->executeQuery('DELETE from TNews where DATEDIFF(heure, sysdate()) < -30',array());
    }

    // fonction qui retourne le nombre de news qui ont le même site que passé en paramètre
    public function findNews($site){
        $this->con->executeQuery('SELECT count(*) nb from TNews where site=:site',array(':site'=>array($site, PDO::PARAM_STR)));
        return $this->con->getResults()[0]["nb"];
    }

    // fonction qui retourne la liste des catégories
    public function findCat(){
        $tCat=[];
        $this->con->executeQuery('SELECT categorie from TNews group by categorie',array());
        
        $resultats = $this->con->getResults();
        
        // Pour toutes les valeurs de $resultat on instancie les news dans le tableau $tNews
        foreach ($resultats as $donnee){
            $tCat[] = $donnee['categorie'];
        }
        // On retourne le tableau
        return $tCat;
    }
}
?>
