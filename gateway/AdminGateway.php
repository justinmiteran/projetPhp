<?php

// Gateway des News
class AdminGateway{
    // $con -> connexion et $tNews ->  tableau des news 
    private $con;
    
    
    // Constructeur de la gateway
    public function __Construct(){
        global $base,$login,$mdp;
        $this->con=new Connection($base,$login,$mdp);
    }
    
    public function getMdp($loginAdmin){
        
        $this->con->executeQuery("SELECT hashMdp from tconnexion where pseudo=:login",array(':login'=>array($loginAdmin, PDO::PARAM_STR)));
        $resultats = $this->con->getResults();
        
        // On retourne le mot de passe crypté
        if(sizeof($resultats)==0){
            return null;
        }
        return $resultats[0]['hashMdp'];
    }
    
}
?>
