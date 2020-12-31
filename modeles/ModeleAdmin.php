<?php
Class ModeleAdmin {
    
    function __construct() {
    }
    
    
    function connexion($login, $mdp){
        $login = Validation::string($login);
        $mdp = Validation::string($mdp);
        
        $gate = new AdminGateway();
        $hashMdp =$gate->getMdp($login);
        if(!$hashMdp == null){

            if(password_verify($mdp, $hashMdp)){
                $_SESSION['role']='admin';
                $_SESSION['login']=$login;
                return true;
            }
        }
        return false;

    }
    
    function deconnexion(){
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

        
    function isAdmin(){
        if(isset($_SESSION['role']) && isset($_SESSION['login'])){
            if(Validation::string($_SESSION['role'])=='admin'){
                return new Admin(Validation::string($_SESSION['login']));
            }
        }
        return null;
    }
    
}