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
			$action=$_REQUEST['action'];
			switch($action) {

                case NULL:
					$this->afficherNews();
                    break;
                    
				//mauvaise action
				default:
                    $TErreur[] = "mauvaise action";
				    require ($vues['erreur']);
			        break;
		    }
        }
        catch (PDOException $e)
        {
		    //si erreur BD, pas le cas ici
		    $TErreur[] = $e->getMessage();
		    require ($vues['erreur']);
		
	    }
	    catch (Exception $e2)
	    {
		    $TErreur[] = $e2->getMessage();
		    require ($vues['erreur']);
	    }
    }


    function afficherNews(){
        global $vues,$cont;
        $news = new ModeleNews();
        $val = new Validation();
        $pageMax = $news->getNbPages($this->nbNewsPage);

        // si une page est passé dans l'url vérifier sa valeur
        if(isset($_GET['page'])) $pageCourante = $val->valPage($_GET['page'],$pageMax);
        // sinon définir la page courante a 1
        else $pageCourante=1;
        
        $Tnews=$news->getNewsPage($pageCourante,$this->nbNewsPage);
        // si il y a des erreurs de validation
        if(($TErreur = $val->getErreur())) require($vues['erreur']);
        // appeler la vue des News
        else require($vues['vNews']);
    }
}