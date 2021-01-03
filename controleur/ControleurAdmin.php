<?php

class ControleurAdmin{
    
    //variable du nombre de news par page
    protected $nbNewsPage = 10;
    protected $tErreur = array ();

    function __construct() {		
        global $vues;
        if(isset($_SESSION['nbPages'])){
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

    function validerNbPages(){
        $nbPages = Validation::num($_POST['nbPages']);
        $_SESSION['nbPages']=$nbPages;
        var_dump($_SESSION);
        header("Location: index.php"); 
    }

    function afficherRss(){
        // déclaration variables globales
        global $vues,$cont;
        // déclaration constructeurs 
        $rss = new ModeleRss();
        $val = new Validation();

        // récupération d'un tableau des flux rss
        $Trss=$rss-> getRSS();
        // appeler la vue des News

        $admin = new ModeleAdmin();
        $nom = "";
        if(($a=$admin->isAdmin())==null){
            $con = False;
        }
        else{
            $con = True;
            $nom = $a->get_nom();
        } 
        
        require($vues['vListeFlux']);
    }

    function supprimerNews(){
        $mNews = new ModeleNews();
        $val = new Validation();
        $idNews=$val->ValId($_GET['SupNews']);
        $mNews->supprimerNews($idNews);
        if(isset($_GET['page'])) $page = $_GET['page'];
        else $page = 1;
        header("Location: index.php?page=$page"); 
    }

    function supprimerRss(){
        $mRss = new ModeleRss();
        $val = new Validation();
        $idRss=$val->ValId($_GET['SupRss']);
        $mRss->supRSS($idRss);
        header("Location: index.php?action=afficherRss"); 
    }

    function ajouterNews(){
        global $vues;
        $mNews = new ModeleNews();
        $tCat = $mNews->listecat();
        require($vues['vAjoutNews']);
    }

    function ajouterRss(){
        global $vues;
        require($vues['vAjoutFlux']);
    }

    function validerAjoutRss(){
        
        $mRss = new ModeleRss();
        if(!isset($_POST['site'])||!isset($_POST['url'])||!isset($_POST['cat']))
            throw new Exception("Au moin un des paramêtres de création d'un flux rss n'a pas été défini");
        $rss=VALIDATION::ValRss(new RSS(0,$_POST['site'],$_POST['url'],$_POST['cat']));
        $mRss->addRss($rss);
        header("Location: index.php"); 
    }

    function validerAjoutNews(){
        
        $mNews = new ModeleNews();
        if(!isset($_POST['heure'])||!isset($_POST['site'])||!isset($_POST['titre'])||!isset($_POST['description'])||!isset($_POST['categorie'])||!isset($_POST['image']))
            throw new Exception("Au moin un des paramêtres de création d'un article n'a pas été défini");
        $heure = DateTime::createFromFormat("Y-m-d\TH:i",$_POST['heure']);
        $news=VALIDATION::ValNews(new News(0,$heure,$_POST['site'],$_POST['titre'],$_POST['description'],$_POST['categorie'],$_POST['image']));
        $mNews->ajouterNews($news);
        header("Location: index.php"); 
    }

    function deconnexion(){
        $admin = new ModeleAdmin();
        $nom = "";
        if(($a=$admin->isAdmin())!=null){
            $nom = $a->get_nom();
        }
        $admin->deconnexion();
        $this->afficherPageDeconnexion($nom);
    }

    function afficherPageDeconnexion($nom){
        global $vues;
        require($vues['vDeconnexion']);
    }
}