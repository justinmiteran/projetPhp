<?php

require_once("../modeles/News.php");

class NewsGateway{
    private $con;
    private $tNews;
    
    public function __Construct($con){
        $this->con=$con;
        $this->tNews = [];
    }
    
    public function donnerLesNews(){
        $this->con->executeQuery('SELECT * from TNews order by heure desc',array());
        $resultats = $this->con->getResults();
        
        foreach ($resultats as $donnee){
            $this->tNews[] = new News($donnee["heure"], $donnee["site"], $donnee["nom"], $donnee["description"]);
        }
        return $this->tNews;
    }

    public function donnerLesNewsPage($numPage,$newsPage){
        $query = "SELECT * from TNews order by heure desc limit :nbNews offset :debut";
        $this->con->executeQuery($query,array(':nbNews'=>array($newsPage, PDO::PARAM_INT),':debut'=>array(($numPage-1)*$newsPage, PDO::PARAM_INT)));
        
        $resultats = $this->con->getResults();
        
        foreach ($resultats as $donnee){
            $this->tNews[] = new News($donnee["heure"], $donnee["site"], $donnee["nom"], $donnee["description"]);
        }
        return $this->tNews;
    }
    
    public function nb(){
        $this->con->executeQuery('SELECT count(*) NB from TNews',array());
        $nb = $this->con->getResults();
        foreach ($nb as $donnee){
            return $donnee["NB"]; 
        }
    }
    
    public function sup($id){
        $this->con->executeQuery('DELETE from TNews where idNews=:id',array());
    }
}
?>