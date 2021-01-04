<?php

class ControleurUser{
    
    //variable du nombre de news par page
    protected $nbNewsPage = 10;
    protected $tErreur = array ();

    function __construct() {		
        global $vues;
        // test si le nb de news par page est en session
        if(isset($_SESSION['nbPages'])){
            // validation
            $this->nbNewsPage = Validation::num($_SESSION['nbPages']);
        }
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
                case "formulaireConnexion":
                    $this->afficherConnexion();
                    break;
                case "connexion":
                    $this->connexion();
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
        catch (PDOException $e){
		    // si erreur dans la BDD ajout d'une erreur
            $TErreur[] = $e->getMessage();
            // appel de la vue d'erreur
		    require ($vues['erreur']);
		
	    }
	    catch (Exception $e2){
            // ajout d'une erreur
            $TErreur[] = $e2->getMessage();
            // appel de la vue d'erreur
		    require ($vues['erreur']);
	    }
    }

    // function d'affiche de news par pages
    function afficherNews(){
        // déclaration variables globales
        global $vues;
        // déclaration constructeurs 
        $news = new ModeleNews();
        $val = new Validation();

        // récupération de nombre de pages
        if(isset($_GET['cat'])){
            $cat=$val->string($_GET['cat']);
            $pageMax = $news->getNbPagesCat($this->nbNewsPage,$cat);
        }
        else $pageMax = $news->getNbPages($this->nbNewsPage);

        // si une page est passé dans l'url vérifier sa valeur
        if(isset($_GET['page'])) $pageCourante = $val->valPage($_GET['page'],$pageMax);
        // sinon définir la page courante a 1
        else $pageCourante=1;

        // récupération d'un tableau de news
        if(isset($_GET['cat'])){
            $cat=$val->string($_GET['cat']);
            $Tnews=$news->getNewsPageCat($pageCourante,$this->nbNewsPage,$cat);
        }
        else $Tnews=$news->getNewsPage($pageCourante,$this->nbNewsPage);
        // appeler la vue des News

        // liste des categories
        $tCat = $news->listecat();

        // declaration modele admin
        $admin = new ModeleAdmin();
        // initialisation du nom
        $nom = "";
        // test admin
        if(($a=$admin->isAdmin())==null){
            $con = False;
        }
        else{
            $con = True;
            $nom = $a->get_nom();
        }
 
        // appel de la vue des news
        require($vues['vNews']);
    }

    // formulaire connexion
    function afficherConnexion(){
        global $vues;
        // declaration modele
        $admin = new ModeleAdmin();
        // test pas admin
        if($admin->isAdmin()==null){
            // appel de la vue de connexion
            require($vues['vConnexion']);
        }
        // afficher la page principale
        else $this->afficherNews();
    }

    // validation de la connexion
    function connexion(){
        global $vues;
        // appeler la vue des News
        $admin = new ModeleAdmin();
        // test si le login et mot de passe n'éxiste pas
        if(!isset($_POST['login']) || !isset($_POST['mdp'])){
            //appelle la vue de connexion
            $this->afficherConnexion();
            return;
        }
        // validation des variables
        $login=validation::string($_POST['login']);
        $mdp=validation::string($_POST['mdp']);
        // connexion
        $reussi = $admin->connexion($login,$mdp);
        // test de reussite de connexion
        if($reussi){
            // appel de la vue principale
            header("Location: index.php"); 
        }
        // appel vue connexion
        else require($vues['vConnexion']);
    }
}