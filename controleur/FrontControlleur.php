<?php

class FrontControlleur{
    
    function __construct() {		
        global $vues;
        //on initialise un tableau d'erreur
        $TErreur = array ();
        // liste action admin
        $listeAction_Admin= array('deconnexion','supprimerNews','ajouterNews','validerAjoutNews','ajouterRss','validerAjoutRss','afficherRss','supprimerRss','validerNbPages');
        session_start();
        //appel modèle admin pour vérifier si utilisateur est connecté
        Try{
            // declaration modele
            $modeleAdmin = new ModeleAdmin();
            // test admin
            $admin = $modeleAdmin->isAdmin(); 
            // test action
            if(isset($_REQUEST['action'])){
                $action=$_REQUEST['action'];
                // validation action
                $action = Validation::string($action);
            }
            else {
                $action=null;
            }
            // test si action est en admin
            if(in_array($action,$listeAction_Admin)){
                // test pas admin
                if($admin==null){
                    // appel vue connexion
                    require($vues['vConnexion']);
                }
                //appel controleur admin
                else new ControleurAdmin();
            }
            else{
                // appel controler user
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