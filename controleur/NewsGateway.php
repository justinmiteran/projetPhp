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
        $this->con->executeQuery('select * from TNews order by heure',array());
        $resultats = $this->con->getResults();
        
        foreach ($resultats as $donnee){
            $this->tNews[] = new News($donnee["heure"], $donnee["site"], $donnee["nom"], $donnee["description"]);
        }
        return $this->tNews;
    }
    
    public function nb(){
        $this->con->executeQuery('select count(*) NB from TNews',array());
        $nb = $this->con->getResults();
        foreach ($nb as $donnee){
            return $donnee["NB"]; 
        }
    }
    
    public function sup($id){
        $this->con->executeQuery('delete from TNews where idNews=:id',array());
    }
}
?>