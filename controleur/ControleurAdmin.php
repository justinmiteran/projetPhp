<?php

class ControleurAdmin{
    
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
                    header("Location: index.php?");
                    break;
                
                case "supprimerNews":
                    $this->supprimerNews();
                    break;
                case "ajouterNews":
                    $this->ajouterNews();
                    break;
                case "validerAjoutNews":
                    $this->validerAjoutNews();
                    header("Location: index.php?");
                    break;
                case "ajouterRss":
                    $this->ajouterRss();
                    break;
                case "validerAjoutRss":
                    $this->validerAjoutRss();
                    header("Location: index.php?");
                    break;
                case "deconnexion":
                    $this->deconnexion();
                    break;
                case "afficherRss":
                    $this->afficherRss();
                    break;
                case "supprimerRss":
                    $this->supprimerRss();
                    break;
                case "validerNbPages":
                    $this->validerNbPages();
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

    //validation du choix du nombre de news par pages
    function validerNbPages(){
        // validation
        $nbPages = Validation::num($_POST['nbPages']);
        // mise du nombre de news en session
        $_SESSION['nbPages']=$nbPages;
        // appel de la page principale
        header("Location: index.php"); 
    }

    //Afficher la liste de flux RSS
    function afficherRss(){
        // déclaration variables globales
        global $vues,$cont;
        // declaration model / validation 
        $rss = new ModeleRss();
        $val = new Validation();

        // récupération d'un tableau des flux rss
        $Trss=$rss-> getRSS();

        // appel du model admin
        $admin = new ModeleAdmin();
        //initialisation du nom de l'admin
        $nom = "";
        // test connexion adminisrateur
        if(($a=$admin->isAdmin())==null){
            $con = False;
        }
        else{
            $con = True;
            $nom = $a->get_nom();
        } 
        
        // appel vue liste de flux
        require($vues['vListeFlux']);
    }

    // supprimer une news de la BDD
    function supprimerNews(){
        // declaration model / validation 
        $mNews = new ModeleNews();
        $val = new Validation();
        // validation de l'ID de la news
        $idNews=$val->ValId($_GET['SupNews']);
        // suppression de la news
        $mNews->supprimerNews($idNews);
        // test si l'utilisateur etais sur une page précise
        if(isset($_GET['page'])) $page = $_GET['page'];
        else $page = 1;
        // appel de la vue principale
        header("Location: index.php?page=$page"); 
    }

    // supprimer un flux rss
    function supprimerRss(){
        // declaration model / validation 
        $mRss = new ModeleRss();
        $val = new Validation();
        // validation de l'ID du flux rss
        $idRss=$val->ValId($_GET['SupRss']);
        // suppression du flux
        $mRss->supRSS($idRss);
        // appel de la vue des flux RSS
        header("Location: index.php?action=afficherRss"); 
    }

    // ajouter une news
    function ajouterNews(){
        global $vues;
        //declaration modele
        $mNews = new ModeleNews();
        // recuperation de la liste des categories de news
        $tCat = $mNews->listecat();
        // appel du formulaire d'ajout d'une news
        require($vues['vAjoutNews']);
    }

    // ajouter un flux RSS
    function ajouterRss(){
        global $vues;
        // appel du formulaire d'ajout de flux RSS
        require($vues['vAjoutFlux']);
    }

    // valider l'ajout d'un flux RSS
    function validerAjoutRss(){
        // declaration modele
        $mRss = new ModeleRss();
        // test si les valeurs du formulaire existes
        if(!isset($_POST['site'])||!isset($_POST['url'])||!isset($_POST['cat']))
            throw new Exception("Au moin un des paramêtres de création d'un flux rss n'a pas été défini");
        // validation des valeurs du formulaire
        $rss=VALIDATION::ValRss(new RSS(0,$_POST['site'],$_POST['url'],$_POST['cat']));
        // ajout du flux RSS
        $mRss->addRss($rss);
        // appel de la vue principale
        header("Location: index.php"); 
    }

    // valider l'ajout d'une news
    function validerAjoutNews(){
        // declaration modele
        $mNews = new ModeleNews();
            // test si les valeurs du formulaire existes
        if(!isset($_POST['heure'])||!isset($_POST['site'])||!isset($_POST['titre'])||!isset($_POST['description'])||!isset($_POST['categorie'])||!isset($_POST['image']))
            throw new Exception("Au moin un des paramêtres de création d'un article n'a pas été défini");
        //création du format de l'heure
        $heure = DateTime::createFromFormat("Y-m-d\TH:i",$_POST['heure']);
        // validation des valeurs du formulaire
        $news=VALIDATION::ValNews(new News(0,$heure,$_POST['site'],$_POST['titre'],$_POST['description'],$_POST['categorie'],$_POST['image']));
        // ajout de la News
        $mNews->ajouterNews($news);
        // appel de la vue principale
        header("Location: index.php"); 
    }

    // deconnexion
    function deconnexion(){
        global $vues;
        // declaration modele
        $admin = new ModeleAdmin();
        // initialisation du nom
        $nom = "";
        // test de la connexion administrateur
        if(($a=$admin->isAdmin())!=null){
            $nom = $a->get_nom();
        }
        // deconexion
        $admin->deconnexion();
        // appel vue de déconnexion
        require($vues['vDeconnexion']);
    }
}