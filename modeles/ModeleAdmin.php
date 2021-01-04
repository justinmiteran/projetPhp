<?php
Class ModeleAdmin {
    
    function __construct() {
    }
    
    // fonction de connexion admin
    function connexion($login, $mdp){
        // Validation des attributs passés en paramètre
        $login = Validation::string($login);
        $mdp = Validation::string($mdp);
        
        // Crée la gateway admin
        $gate = new AdminGateway();
        // Récupération du hash du MDP de personne qui veut se connécter
        $hashMdp =$gate->getMdp($login);
        // si le mot de passe est différent de null
        if(!$hashMdp == null){
            // Si le mdp et le hash correspondent alors le rôle de la session devient admin et le login de session devient le login de la personne connécté et return true
            if(password_verify($mdp, $hashMdp)){
                $_SESSION['role']='admin';
                $_SESSION['login']=$login;
                return true;
            }
        }
        // sinon return false
        return false;

    }
    
    // Fonction de deconnexion
    function deconnexion(){
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    // Fonction de test pour administrateur
    function isAdmin(){
        if(isset($_SESSION['role']) && isset($_SESSION['login'])){
            if(Validation::string($_SESSION['role'])=='admin'){
                return new Admin(Validation::string($_SESSION['login']));
            }
        }
        return null;
    }
    
}