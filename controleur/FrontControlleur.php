<?php

class FrontControlleur{
    
    function __construct() {		
        global $vues;
        //on initialise un tableau d'erreur
        $TErreur = array ();
        $listeAction_Admin= array('deconnexion','supprimer','ajouter','validerAjoutNews');
        session_start();
        //appel modèle admin pour vérifier si utilisateur est connecté
        Try{
            $modeleAdmin = new ModeleAdmin();
            $admin = $modeleAdmin->isAdmin(); 
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
                $action = Validation::string($action);
            }
            else {
                $action=null;
            }
            if(in_array($action,$listeAction_Admin)){
                if($admin==null){
                    require($vues['vConnexion']);
                }
                else new ControleurAdmin();
            }
            else{
                new ControleurUser();
            }
        }
        catch (PDOException $e)
        {
            // si erreur dans la BDD ajout d'une erreur
            $TErreur[] = $e->getMessage();
            // appel de la vue d'erreur
            require ($vues['erreur']);
            
        }
        catch (Exception $e2)
        {
            // ajout d'une erreur
            $TErreur[] = $e2->getMessage();
            // appel de la vue d'erreur
            require ($vues['erreur']);
        }
    }
    
}