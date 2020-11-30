<?php

class ControleurUser{
    
    //variable du nombre de news par page
    protected $nbNewsPage = 2;
    protected $tErreur = array ();

    function __construct() {		
        global $vues;
		//on initialise un tableau d'erreur
        $TErreur = array ();
        
		try{
            //recupération de l'action
			$action=$_REQUEST['action'];
			switch($action) {

                // si action null
                case NULL:
                    //affiche la page de news
					$this->afficherNews();
                    break;
                    
				//sinon
                default:
                    // ajout d'une erreur
                    $TErreur[] = "action invalide";
                    // appel de la vue d'erreur
				    require ($vues['erreur']);
			        break;
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

    // function d'affiche de news par pages
    function afficherNews(){
        // déclaration variables globales
        global $vues,$cont;
        // déclaration constructeurs 
        $news = new ModeleNews();
        $val = new Validation();

        // récupération de nombre de pages
        $pageMax = $news->getNbPages($this->nbNewsPage);

        // si une page est passé dans l'url vérifier sa valeur
        if(isset($_GET['page'])) $pageCourante = $val->valPage($_GET['page'],$pageMax);
        // sinon définir la page courante a 1
        else $pageCourante=1;

        // récupération d'un tableau de news
        $Tnews=$news->getNewsPage($pageCourante,$this->nbNewsPage);
        // appeler la vue des News
        require($vues['vNews']);
    }
}