<?php
class NewsGateway{
    private $con;
    private $tNews;
    
    public function __Construct($con){
        $this->con=$con;
    }
    
    public function donnerLesNews():array{
        $this->con->executeQuery('select * from TNews order by date',array());
        $resultats = $this->con->getResults();
        
        foreach ($results as $donnee){
            $this->tNews[] = new News($);
        }
        return $this->news;
    }
    
    public function nb():int{
        $this->con->executeQuery('select count(*) from TNews',array());
        $nb = $this->con->getResults();
        return $nb;
    }
    
    public function sup($id){
        $this->con->executeQuery('delete from TNews where idNews=:id',array());
    }
}
?>