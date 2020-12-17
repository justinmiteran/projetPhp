<?php
Class ModeleAdmin {
    
    function __construct() {
    }
    
    // fonction de récupération des news pour une page
    function supprimerNews($idNews){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new NewsGateway();       
        // récupération des news
        return $gate->sup($idNews);
    }
    
    // fonction de récupération du nombre de pages
    function ajouterNews($news){
        // initialisation de la class NewsGateway et de la classe Validation
        $gate = new NewsGateway();
        // récupération du nombre max de pages
        return $gate->add($news);
    }
    
    function isAdmin(){
        if(isset($_SESSION['role']) && isset($_SESSION['login'])){
            if(Validation::string($_SESSION['role'])=='admin'){
                return new Admin(Validation::string($_SESSION['role']));
            }
        }
        return null;
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
    
    
}